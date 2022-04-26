<?php
    @session_start();
    $_SESSION['jump']--;
    header ('Location: ./index-cat.php');   
    die;
    ?>