<?php
    session_start();
    require 'functions.php';

    if (!isset($_POST['login'])) {
        $_SESSION['status'] = false;
        header ('Location: ../index.php');
        die;
    }

    $login = clean($_POST['login']);
    $passwd = clean($_POST['passwd']);
    $result = find_user($login); 

    // var_dump($result);
    // var_dump($login);
    // var_dump($passwd);
    

    if($result==false) {
        $_SESSION['error'] = $login ;
        header ('Location: ../login.php?error=nouser');
        die;
    }
    else {
        if(password_verify(($passwd),$result['passwd'])) {

            $_SESSION['status']= true;
            $_SESSION['login'] = $login;
            unset($_SESSION['error']);
            header ('Location: ../index.php');
            die;    
        }   
        else {
            $_SESSION['error'] = $login ;
            header ('Location: ../login.php?error=nouser');
            die;
        } 
    }      

