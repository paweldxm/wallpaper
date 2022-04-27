<?php
    @session_start();
    $_SESSION['csite']++;
    header ('Location: ../category.php');
    die;
    ?>