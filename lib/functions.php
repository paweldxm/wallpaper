<?php
function rand_col() {
    $col1 = rand(0,255);
    $col2 = rand(0,255);
    $col3 = rand(0,255);
    $col = 'rgb('.$col1.','.$col2.','.$col3.')';
    return $col;
    
}

function get_connection()
{
    $config = require 'config.php';
    $pdo = new PDO(
        $config['database_dsn'],
        $config['database_user'],
        $config['database_pass']
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
}
function get_cat()
{
    $pdo = get_connection();
    $query = 'select name from category GROUP by name ASC' ;
    $stmt = $pdo->query($query);
    $stmt->execute();
    return $stmt->fetchAll();
}
function get_users()
{
    $pdo = get_connection();
    $query = 'select * from users GROUP by date DESC' ;
    $stmt = $pdo->query($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

function get_wp()
{
    $pdo = get_connection();
    $query = 'select id,login,date from users GROUP by date DESC' ;
    $stmt = $pdo->query($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

$bcon=mysqli_connect("localhost","root","","wallpaper");
