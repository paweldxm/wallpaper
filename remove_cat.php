<?php
    @session_start();

    if(!isset($_SESSION['status'])) {
        header('Location: index.php');
        exit();
    }
    else {
        
        $id = $_GET['id'];
        $bcon=mysqli_connect("localhost","root","","wallpaper"); 
        $query = 'DELETE FROM category WHERE ID=' . $id;
        mysqli_query($bcon,$query);
        mysqli_close($bcon);
        header('Location: ../category.php');
        die;
    }
?>
