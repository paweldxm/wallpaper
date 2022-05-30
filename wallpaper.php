<?php
    session_start();
    $page = 'wallpap';
    require './layout/header.php'; 

    if(!isset($_SESSION['status'])) {
        header('Location: ./index.php');
        exit();
    }
?>
<aside>
    <a href="./wallpaper-add.php">
        <h3>DODAJ NOWĄ TAPETĘ</h3>
    </a>
    <?php
        if (isset($_GET['error']))  echo "<p>". $_GET['error'] ."</p>"; 
        echo '<br>';
        require './lib/wall.php';
        echo '<br></aside>';
    require './layout/footer.php';
        
