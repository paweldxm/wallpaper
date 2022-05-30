<?php
    session_start();
    require 'functions.php';

    if(!isset($_SESSION['status'])) {
        header('Location: ../index.php');
        die;
    }    
    $id = clean($_GET['id']);
    $img = show_img($id);
    $rimg = remove_img($id);
        
    $file = $img['file'];
        
    $file1 = './uploads/'.$file;
    $file2 = './uploads/mini/'.$file;
    $file3 = './uploads/small/'.$file;              

    unlink($file1);
    unlink($file2);
    unlink($file3);
    header('Location: ../wallpaper.php');
    die;
?>
