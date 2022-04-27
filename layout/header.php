<?php
    @session_start();

?>
<html lang="en,pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="wallpapers, wallpaper, tapety, dreamscreen" />
    <meta name="author" content="Pawel Pasik" />
    <meta name="copyright" content="DXM" />
    <meta name="robots" content="follow" />
    <meta http-equiv="expires" content="43200" />
    <meta name="description" content="The best webservice with wallpapers. Wall pappers. HD WIDE">


    <title>DreamScreen</title>
    <link rel="stylesheet" href="css/style.css">
    <script language="javascript">
        function show() {

            var el = document.getElementById("hideMe");
            var text = document.getElementById("showMe");
            if (el.style.display == "block") {
                el.style.display = "none";

            } else {
                el.style.display = "block";
            }
        }

    </script>
</head>

<body>
    <header>
        <div id="header">
            <div id="logo">
                <a href="./index.php">
                    <?php
                require_once './lib/functions.php';
                echo '<div id="l1"><span style="color:'. rand_col() .';">W</span>'; 
                echo '<span style="color:'. rand_col() .';">A</span>'; 
                echo '<span style="color:'. rand_col() .';">L</span>'; 
                echo '<span style="color:'. rand_col() .';">L</span></div>'; 
                echo '<div id="l2"><img src="images/logo.png" alt="logo" /></div>';
                echo '<div id="l3"><span style="color:'. rand_col() .';">P</span>'; 
                echo '<span style="color:'. rand_col() .';">A</span>'; 
                echo '<span style="color:'. rand_col() .';">P</span>'; 
                echo '<span style="color:'. rand_col() .';">E</span>'; 
                echo '<span style="color:'. rand_col() .';">R</span>'; 
                echo '<span style="color:'. rand_col() .';">S</span></div>'; ?>
                </a>
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
