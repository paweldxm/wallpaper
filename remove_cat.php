<?php
    @session_start();

        if(!isset($_SESSION['status'])) {
            header('Location: ./index.php');
            exit();
        }
        require './lib/functions.php';
        $id = $_GET['id'];
        $bcon = fast_conn();
        $query = 'DELETE FROM category WHERE ID=' . $id;
        mysqli_query($bcon,$query);
        mysqli_close($bcon);
        header('Location: ../category.php');
        die;
    ?>
