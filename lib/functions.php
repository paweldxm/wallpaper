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

function fast_conn(){
    $bcon = mysqli_connect("localhost","root","","wallpaper");
    return $bcon;
    
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

function get_wall()
{
    
    $pdo = get_connection();
    $query = 'select file from files GROUP by date DESC' ;
    $stmt = $pdo->query($query);
    $stmt->execute();
    return $stmt->fetchAll();
}
function show_img($id)
{
    $pdo = get_connection();
    $query = 'SELECT * FROM files WHERE files.id = :idVal';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam('idVal', $id);
    $stmt->execute();

    return $stmt->fetch();
}
function show_cat($cat)
{
    $pdo = get_connection();
    $find = 'SELECT file,res,id FROM files WHERE category= :catVal';
    $stmt = $pdo->prepare($find);
    $stmt->bindParam('catVal', $cat);
    $stmt->execute();
    return $stmt->fetchAll();
}
function remove_img($id)
{
    $pdo = get_connection();
    $query = 'DELETE FROM files WHERE files.id= :idVal';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam('idVal', $id);
    $stmt->execute();
}
function sizeMB($filename) {
    $file = filesize($filename);
  return round( $file / 1024 / 1024, 2) . 'MB';
}
