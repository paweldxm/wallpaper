<?php
@session_start();
session_unset();
session_destroy(); 
//unset $_SESSION['status'];

header ('Location: index.php');
exit();
?>
