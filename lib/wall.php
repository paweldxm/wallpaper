<span>Lista tapet w bazie (aktualnie <b><?php
    $bcon = fast_conn();
    if (mysqli_connect_errno()) echo "Brak połączenia z bazą MySQL";
    else {
        $find = "SELECT * FROM files ORDER BY files.date DESC";
        $result = mysqli_query($bcon,$find);
        $total = mysqli_num_rows($result);
        $per_page = 20;
        $cur_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $skip = (($cur_page - 1) * $per_page);

        $howMuch = ceil($total / $per_page);
        $find .= " LIMIT $skip, $per_page";

        $result = mysqli_query($bcon, $find);
        
        echo $total .'</b>)</span>';
            echo '<table id="files"><tr class="tab-menu"><td>id</td><td class="data">data dodania</td><td>nazwa tapety(plik)</td><td></td><td></td></tr>';
            while($row = mysqli_fetch_array($result)) {
                echo "<tr><td>" . $row['id'] ."</td><td class='data'>" ;
                echo $row['date'] . "</td>";
                echo '<td class="file">';
                echo $row['name'] ;
                ?>
        <div class="hidden">
            <?php
                echo '<img src="./uploads/mini/';
                echo $row['file'];
                echo '"/><br>';
                echo $row['file'];
            ?>
        </div>

        <?php
            echo '</td><td><a href="wallpaper-edit.php?id=' . $row['id'] . '">edytuj</a></td><td>' ;
        ?>
        <a onclick="return confirm('Jesteś pewny, że chcesz usunąć tapetę?');" href="./lib/remove_file.php?id=<?php echo $row['id'] . '">usuń</a></td></tr>';    
            }
        echo '</tr></table><br>';

        if ($howMuch == 1)  echo '<ul class="pagination"><li><a class="active" href="./wallpaper.php">1</a></li></ul>';
        if ($howMuch > 1) {
            echo '<ul class="pagination">';
            echo generate_page_links($cur_page, $howMuch);
            echo '</ul>';
        }   
        mysqli_close($bcon);
    }
?>