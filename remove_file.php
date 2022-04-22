<?php
    @session_start();

    if(!isset($_SESSION['status'])) {
        header('Location: ./index.php');
        exit();
    }
    else {
        require './lib/functions.php';
        $id = $_GET['id'];
        $img = show_img($id);
        $rimg = remove_img($id);
        
        $file = $img['file'];
        
        $f1 = './uploads/'.$file;
        $f2 = './uploads/mini/'.$file;
        $f3 = './uploads/small/'.$file;              

        unlink($f1);
        unlink($f2);
        unlink($f3);
        header('Location: ../wallpap.php');
        die;
    }
?>
