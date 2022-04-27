<?php
    @session_start();
    $_SESSION['usite']--;
    header ('Location: ../users.php');
    die;
    ?>