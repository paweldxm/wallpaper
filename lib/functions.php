<?php
function rand_col() {
    $col1 = rand(4,165);
    $col2 = rand(33,95);
    $col3 = rand(31,97);
    $col = 'rgb('.$col1.','.$col2.','.$col3.')';
    return $col;
}

function sizeMB($filename) {
    $file = filesize($filename);
    return round($file / 1024 / 1024, 2) . 'MB';
}

function get_connection() {
    $config = require 'config.php';
    $pdo = new PDO(
        $config['db_dsn'],
        $config['db_user'],
        $config['db_pass']
    );
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}

function fast_conn() {
    $mysqli = mysqli_connect("localhost","ucsxgcvewm_pawel","-IpkLD2vS6ql-T0]","ucsxgcvewm_wallpaper");
    return $mysqli;
}

// USERS 
function get_users() {
    $pdo = get_connection();
    $query = 'select * from users GROUP by date DESC' ;
    $stmt = $pdo->query($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

function show_user($id) {
    $pdo = get_connection();
    $query = 'SELECT * FROM users WHERE ID = :idVal';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam('idVal', $id);
    $stmt->execute();
    return $stmt->fetch();
}

function del_user($id) {
    $pdo = get_connection();
    $query = 'DELETE FROM users WHERE ID = :idVal';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam('idVal', $id);
    $stmt->execute();
    return $stmt->fetch();
}

function find_user($login) {
    $pdo = get_connection();
    $query = 'SELECT * FROM users WHERE login= :loginVal';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam('loginVal', $login);
    $stmt->execute();
    return $stmt->fetch();
}

// CATEGORY 
function get_cat() {
    $pdo = get_connection();
    $query = 'select name from category GROUP by name ASC' ;
    $stmt = $pdo->query($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

function show_cat($cat) {
    $pdo = get_connection();
    $find = 'SELECT * FROM files WHERE category= :catVal';
    $stmt = $pdo->prepare($find);
    $stmt->bindParam('catVal', $cat);
    $stmt->execute();
    return $stmt->fetchAll();
}

function find_cat($id) {
    $pdo = get_connection();
    $query = "SELECT * FROM category WHERE ID = :idVal";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam('idVal', $id);
    $stmt->execute();
    return $stmt->fetch();
}

function show_category($name) {
    $pdo = get_connection();
    $query = "SELECT * FROM category WHERE name = :nameVal";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':nameVal', $name);
    $stmt->execute();
    return $stmt->fetch();
}

function add_category($name) {
    $pdo = get_connection();
    $query = "INSERT INTO category VALUES(null,:nameVal,CURRENT_TIMESTAMP)" ;
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':nameVal', $name);
    return $stmt->execute(); 
}

function del_category($cat) {
    $pdo = get_connection();
    $query = 'DELETE FROM category WHERE name = :catVal';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam('catVal', $cat);
    $stmt->execute();
    return $stmt->fetch();
}


// FILES 
function get_wall() {
    $pdo = get_connection();
    $query = 'select file from files GROUP by date DESC' ;
    $stmt = $pdo->query($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

function show_img($id) {
    $pdo = get_connection();
    $query = 'SELECT * FROM files WHERE files.id = :idVal';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam('idVal', $id);
    $stmt->execute();
    return $stmt->fetch();
}

function show($var) {
    switch ($var) {
        case "max":
            $x = 'width' ;
            break;
        
        case "new":
            $x = 'date' ;
            break;
    }
    $query = "SELECT * FROM files ORDER BY ".$x."  DESC LIMIT 8" ;
    $pdo = get_connection();
    $stmt = $pdo->query($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

function remove_img($id) {
    $pdo = get_connection();
    $query = 'DELETE FROM files WHERE files.id= :idVal';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam('idVal', $id);
    $stmt->execute();
}

function clean($id) {
    $id = htmlspecialchars($id);
    $id = htmlEntities($id, ENT_QUOTES, 'UTF-8');
    return $id;
}

function generate_page_links($cur_page, $num_pages) {
    $page_links = '';
    if ($cur_page > 1) {
         $page_links .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?page=' . ($cur_page - 1) . '">«</a></li> ';
    }
    $i = $cur_page - 4;
    $page = $i + 8;
    for ($i; $i <= $page; $i++) {
        if ($i > 0 && $i <= $num_pages) {
            if ($cur_page == $i  && $i != 0) {
                $page_links .= '<li><a class="active">' . $i . "</a></li>";
            }
            else {
                if ($i == ($cur_page - 4) && ($cur_page - 5) != 0) { 
                    $page_links .= ' <li><a href="' . $_SERVER['PHP_SELF'] . '?page=1">1</a></li> '; 
                }
                if ($i == ($cur_page - 4) && (($cur_page - 6)) > 0) { 
                    $page_links .= ' <li><a href="' . $_SERVER['PHP_SELF'] . '?page=' . ($cur_page - 5) . '">...</a></li> '; 
                } 
                $page_links .= ' <li><a href="' . $_SERVER['PHP_SELF'] . '?page=' . $i . '"> ' . $i . '</a></li> ';
                if ($i == $page && (($cur_page + 4) - ($num_pages)) < -1) { 
                    $page_links .= ' <li><a href="' . $_SERVER['PHP_SELF'] . '?page=' . ($cur_page + 5) . '">...</a></li>'; 
                } 
                if ($i == $page && ($cur_page + 4) != $num_pages) { 
                    $page_links .= ' <li><a href="' . $_SERVER['PHP_SELF'] . '?page=' . $num_pages . '">' . $num_pages . '</a></li> '; 
                }
            }
        }
    }
    if ($cur_page < $num_pages) {
        $page_links .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?page=' . ($cur_page + 1) . '">»</a></li>';
    }
    return $page_links;
}

function dump($var) {
	echo '<pre>';
	print_r($var);
	echo '</pre>';
}