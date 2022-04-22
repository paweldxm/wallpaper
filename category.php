<?php
    @session_start();
    if(!isset($_SESSION['status']))
    {
        header('Location: ./index.php');
        exit();
    }
    require './layout/header.php';
    require './layout/menu.php'; 
        if(isset($_POST['name'])){
            $status = true;
            $name = $_POST['name'];
            $a = strlen($name);
            if (($a<2) || ($a>20)) 
                {
                    $status = false;
                    $_SESSION['e_cat']='Kategoria musi posiadać co najmniej 3 znaki!';
                } 
            try {
            $pdo = get_connection();
            $catn = "SELECT * FROM category WHERE name='$name'";
            $result1 = $pdo->query($catn);
            $row1 = $result1->fetch(); 
            if($row1==true)
                    {
                        $status = false;
                        $_SESSION['e_cat']='Taka kategoria już istnieje!';
                    }
            }
            catch(Exception $e)
            {
                echo'<span class="error">Błąd serwera! Zapraszamy później!</span>';
                echo '<br/>Informacja developerska: '.$e;
            }
            if($status==true) {
                $pdo = get_connection();
                $add = "INSERT INTO category VALUES(null,'$name',CURRENT_TIMESTAMP)" ;
                $pdo->query($add);
                header ('Location: ./category.php');
                exit();
            }
        }
?>

<aside>
    <a id="showMe" href="javascript:show();">
        <h3>DODAJ NOWĄ KATEGORIĘ</h3>
    </a>
    <div id="hideMe" style="display: none;">
        <form action="category.php" method="POST" ENCTYPE="multipart/form-data">
            <div>
                <label>Nazwa kategori</label>
                <input type="text" name="name" />
            </div>
            <button type="submit">Wyślij</button>
        </form>
    </div>
    <br><br>
    <span>Lista kategori w bazie:</span>
    <?php
    $bcon=mysqli_connect("localhost","root","","wallpaper");
    if (mysqli_connect_errno())
    {
        echo "Nie można się połączyć z bazą";
    }
    else {
        echo '<table><tr><td>id</td><td>data dodania</td><td>nazwa</td><td></td><td></td>';

        $result = mysqli_query($bcon,"SELECT * FROM category");
        while($row = mysqli_fetch_array($result))
        {
            echo "<tr><td>" . $row['id'] . "</td><td>" . $row['date'] . "</td><td>" . $row['name'] . "</td><td> ";
            echo '<a href="./editcat.php?id=' . $row['id'] . '        ">edytuj</a></td><td>' ;
            ?>
    <a onclick="return confirm('Jesteś pewny, że chcesz usunąć dane?');" href="./remove_cat.php/?id=<?php echo $row['id'] . '">usuń</a></td></tr>';    

            }
            echo '</tr></table>';
            mysqli_close($bcon);
        }
echo'<br></aside>';
require './layout/footer.php';
       ?>
