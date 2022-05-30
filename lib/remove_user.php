<?php
    session_start();
    require 'functions.php';
    if(!isset($_SESSION['status'])) {
        header('Location: ./index.php');
        die;
    }
    $id = clean($_GET['id']);
    del_user($id);
    header('Location: ../users.php');
    die;
?>
