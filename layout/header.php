<?php
    @session_start();
//    require './lib/login.php';

?>
<html lang="en,pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DreamScreen</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <div id="header">
            <div id="logo">
                <a href="index.php"><img src="images/logo.png" alt="logo" /></a>

            </div>
            <div class="menu">
                <?php
                if (isset($_SESSION['login'])!=null)
                {
                    require 'logout.php';
                }
                else
                {
                    require 'logon.php';
                }
                ?>
            </div>
        </div>
        <?php require './layout/category-list.php'; ?>


    </header>
