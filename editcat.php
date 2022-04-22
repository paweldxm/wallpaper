<?php 
    @session_start();
    if(!isset($_SESSION['status']))
    {
        header('Location: ./index.php');
        exit();
    }
    
    require './layout/header.php'; 
    require './layout/menu.php'; 

    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $pdo = get_connection();
        $query = "SELECT * FROM category WHERE id= ".$id;
        $result = $pdo->query($query);
        $stmt = $result->fetch();
        $catold = $stmt['name'];    
        $_SESSION['editcat'] = $catold;
        $_SESSION['editid']=$id;
    }
    if(isset($_POST['name'])) {
                var_dump($_SESSION['editid']);

                $pdo = get_connection();
                $newid=$_SESSION['editid'];
                $catt = $_POST['name'];
                $catt2 = $_SESSION['editcat'];
                $edit = "UPDATE category SET name='$catt' WHERE id= ".$newid;
                $edit2 = "UPDATE files SET category='$catt' WHERE category='".$catt2."'";
                $pdo->query($edit);
                $pdo->query($edit2);

                header('Location: ./category.php');
                die;
                }

?>
<aside>
    <div>
        <h3>EDYTUJ KATEGORIĘ
            <?php
                echo ' <b><u>' . $_SESSION['editcat'] . '</u></b>';
            
            ?>
        </h3>
        <form action="./editcat.php" method="POST" ENCTYPE="multipart/form-data">
            <div>
                <label required>Zmień nazwę</label>
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
            echo '<a href="#editcat.php?id=' . $row['id'] . '        ">edytuj</a></td><td>' ;
            ?>
    <a onclick="return confirm('Jesteś pewny, że chcesz usunąć dane?');" href="./remove_cat.php/?id=<?php echo $row['id'] . '">usuń</a></td></tr>';    

            }
            echo '</tr></table>';
            mysqli_close($bcon);
        }
echo'<br></aside>';
require './layout/footer.php';
?>
