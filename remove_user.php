<?php
    @session_start();

    if(!isset($_SESSION['status'])) {
        header('Location: index.php');
        exit();
    }
    else {
        
        $id = $_GET['id'];
        $query = 'DELETE FROM users WHERE ID=' . $id;
        $bcon=mysqli_connect("localhost","root","","wallpaper");
        mysqli_query($bcon,$query);
        mysqli_close($bcon);
        header('Location: ../users.php');
        die;
    }

require './layout/footer.php';

?>
