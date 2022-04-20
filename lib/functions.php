<?php

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
function display_data($data) {
    $output = "<table>";
    foreach($data as $key => $var) {
        //$output .= '<tr>';
        if($key===0) {
            $output .= '<tr>';
            foreach($var as $col => $val) {
                $output .= "<td>" . $col . '</td>';
            }
            $output .= '</tr>';
            foreach($var as $col => $val) {
                $output .= '<td>' . $val . '</td>';
            }
            $output .= '</tr>';
        }
        else {
            $output .= '<tr>';
            foreach($var as $col => $val) {
                $output .= '<td>' . $val . '</td>';
            }
            $output .= '</tr>';
        }
    }
    $output .= '</table>';
    echo $output;
}
