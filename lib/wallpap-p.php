<?php
    @session_start();
    $_SESSION['site']--;
    header ('Location: ../wallpap.php');
    die;
    ?>