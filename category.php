<?php
    session_start();
    $page = 'category';
    require './layout/header.php';

    if(!isset($_SESSION['status'])) {
        header('Location: ./index.php');
        exit();
    }
?>
<aside>
    <a href="./category-add.php">
        <h3>DODAJ NOWĄ KATEGORIĘ</h3>
    </a>
<?php
    if (isset($_GET['error']))  echo "<p>". $_GET['error'] ."</p>"; 
    echo '<br>';
    require './lib/cat.php';
    