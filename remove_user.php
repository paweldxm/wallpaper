<?php
    @session_start();

    if(!isset($_SESSION['status'])) {
        header('Location: ./index.php');
        exit();
    }
    else {
        $bcon=mysqli_connect("localhost","root","","wallpaper"); 

        $id = $_GET['id'];
        $query = 'DELETE FROM users WHERE ID=' . $id;

        mysqli_query($bcon,$query);
        mysqli_close($bcon);
        header('Location: ../users.php');
        die;
    }
?>
