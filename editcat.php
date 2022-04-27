<?php 
    @session_start();
    if(!isset($_SESSION['status']))
    {
        header('Location: ./index.php');
        exit();
    }
    if(isset($_SESSION['acat']))
    {
        $_SESSION['acat']=null;
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
    <?php
    require './lib/cat.php';