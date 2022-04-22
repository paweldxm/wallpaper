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

    <h3>DODAJ NOWĄ TAPETĘ</h3>
    <div>
        <form action="./upload.php" method="POST" ENCTYPE="multipart/form-data">

            <div>
                <input type="file" name="image">
            </div>
            <div>
                <label>Nazwa tapety</label>
                <input type="text" name="name" />
            </div>
            <div>
                <label>Opis tapety</label>
                <input type="text" name="content" />
            </div>
            <div>Wybierz kategorię<br>
                <select name="category" size="5">
                    <?php
                        $cat = get_cat();
                           foreach ($cat as $cate) {

                               echo "<option>" . $cate['name'] . "</option>";

                           }
                
                    ?>
                </select>
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
        echo '<table><tr><td>id</td><td>data dodania</td><td>nazwa pliku</td><td></td><td></td>';
        $result = mysqli_query($bcon,"SELECT * FROM files");
        while($row = mysqli_fetch_array($result))
        {
            echo "<tr><td>" . $row['id'] . "</td><td>" . $row['date'] . "</td><td>" . $row['name'] . "</td><td> ";
            echo '<a href="#editcat.php?id=' . $row['id'] . '        ">edytuj</a></td><td>' ;
            ?>
    <a onclick="return confirm('Jesteś pewny, że chcesz usunąć tapetę?');" href="#./remove_wall.php/?id=<?php echo $row['id'] . '">usuń</a></td></tr>';    
        }
    echo '</tr></table>';
    mysqli_close($bcon);
    }
echo'<br></aside>';
require './layout/footer.php';
?>
