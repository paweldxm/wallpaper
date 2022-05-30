<span>Lista kategori w bazie (<b><?php

    $bcon = fast_conn();
    if (mysqli_connect_errno()) echo "Nie można się połączyć z bazą";
    else {
        $find = "SELECT * FROM category ORDER BY category.date DESC";
        $result = mysqli_query($bcon,$find);
        $total = mysqli_num_rows($result);
        $per_page = 20;
        $cur_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $skip = (($cur_page - 1) * $per_page);
        $howMuch = ceil($total / $per_page);
        $find .= " LIMIT $skip, $per_page";
        $result = mysqli_query($bcon, $find);
        echo $total .'</b>)</span>';
        echo '<table><tr class="tab-menu"><td>id</td><td class="data">data dodania</td><td>nazwa</td><td></td><td></td></tr>';

        while($row = mysqli_fetch_array($result)) {
            echo "<tr><td>" . $row['id'] . "</td><td class='data'>" . $row['date'] . "</td><td>" . $row['name'] . "</td><td> ";
            echo '<a href="./category-edit.php?id=' . $row['id'] . '">edytuj</a></td><td>' ;
            ?>
    <a onclick="return confirm('Jesteś pewny, że chcesz usunąć dane?');" href="./category-remove.php?cat=<?php echo $row['name'] . '">usuń</a></td></tr>';    
            }
            echo '</tr></table><br>';
            if ($howMuch == 1)  echo '<ul class="pagination"><li><a class="active" href="./category.php">1</a></li></ul>';
            if ($howMuch > 1) {
                echo '<ul class="pagination">';
                echo generate_page_links($cur_page, $howMuch);
                echo '</ul>';
            }   
            mysqli_close($bcon);
        }
        echo '<br></aside>';
        require './layout/footer.php';  