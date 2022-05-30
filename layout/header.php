<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="wallpapers, wallpaper, tapety, dreamscreen" />
    <meta name="author" content="Pawel Pasik" />
    <meta name="copyright" content="DXM Paweł Pasik" />
    <meta name="robots" content="follow" />
    <meta http-equiv="expires" content="43200" />
    <?php
    if (isset($_SESSION['meta'])) {
        echo '<title>DreamScreen - Tapeta: '. $_SESSION['meta'] .'</title>';
        echo '<meta name="description" content="'. $_SESSION['content'] . '">';
    }
    else {
        echo '<title>DreamScreen';
        if (isset($page)) echo " - " .$page ;
        echo '</title>';
        echo '<meta name="description" content="The best webservice with wallpapers.">';
    }
    
    ?>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <div id="header">
            <div id="logo">
                <a href="./index.php">
                    <?php
                        require './lib/functions.php'; 
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
                        echo '<span style="color:'. rand_col() .';">S</span></div>';
                    ?>
                </a>
            </div>
            <div class="menu">
                
                <?php
                if (isset($_SESSION['login'])!=null) require 'logout.php';
                else echo '<a href="./login.php" class="btn" value="log-in">Zaloguj</a>';
                ?>
            </div>
        </div>
        <?php
            require './layout/category-list.php';
            if(isset($_SESSION['status'])) require './layout/menu.php';
        ?>

    </header>
