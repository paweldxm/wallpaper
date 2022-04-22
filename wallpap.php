<?php
    @session_start();
    if(!isset($_SESSION['status']))
    {
        header('Location: ./index.php');
        exit();
    }
    require './layout/header.php';
    require './layout/menu.php';
?>

<aside>
    <a id="showMe" href="javascript:show();">
        <h3>DODAJ NOWĄ TAPETĘ</h3>
    </a>
    <div id="hideMe" style="display: none">
        <form action="upload.php" method="POST" ENCTYPE="multipart/form-data">
            <div>
                <input type="file" name="image">
            </div>
            <div>Wybierz kategorię<br>
                <select name="category" size="5">
                    <?php
                        $cat = get_cat();
                        foreach ($cat as $cate) {
                               echo "<option>" . $cate['name'] . "</option>";
                           }
                        echo '<option>brak</option>';
                        
                    ?>
                </select>
            </div>
            <div>
                <label>Nazwa tapety</label>
                <input type="text" name="name" />
            </div>
            <div>
                <label>Opis tapety</label>
                <input type="text" name="content" />
            </div>
            <button type="submit">Wyślij</button>
        </form>
    </div>
    <br><br>
    <span>Lista tapet w bazie:</span>
    <?php
    $bcon = fast_conn();
    if (mysqli_connect_errno())
    {
        echo "Nie można się połączyć z bazą";
    }
    else {
        echo '<table id="files"><tr><td>id</td><td>data dodania</td><td>nazwa tapety(plik)</td><td></td><td></td>';
        $result = mysqli_query($bcon,"SELECT * FROM files");
        while($row = mysqli_fetch_array($result))
        {
            echo "<tr><td>" . $row['id'] ."</td><td>" ;
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
        echo '</td><td><a href="editwall.php?id=' . $row['id'] . '        ">edytuj</a></td>
    <td>' ;
        ?>
    <a onclick="return confirm('Jesteś pewny, że chcesz usunąć tapetę?');" href="./remove_file.php/?id=<?php echo $row['id'] . '">usuń</a></td></tr>';    
        }
    echo '</tr></table>';
    mysqli_close($bcon);
    }
echo'<br></aside>';
require './layout/footer.php';
?>
