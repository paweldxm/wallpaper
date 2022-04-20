<?php
    @session_start();
    require 'functions.php';
    echo $_POST['login'];
//    if (!isset($_SESSION)) {

        
            
            $login = $_POST['login'];
            $passwd = $_POST['passwd'];
            $login = htmlentities($login, ENT_QUOTES,"UTF-8");
            $pdo = get_connection();

        
            if($login !=null)
            {
                $sql = "SELECT * FROM users WHERE login='$login'";
 
                $result = $pdo->query($sql);
                $row = $result->fetch(); 
                if($row==false)
                {
                    $_SESSION['error'] = $login ;
                    header ('Location: ../nouser.php');
                }
                if(password_verify(($passwd),$row['passwd']))
                {
                    $_SESSION['status']= true;
                    $_SESSION['login'] = $row['login'];
                    unset($_SESSION['error']);
//                    @unset($_SESSION['status']);
                    header ('Location: ../index.php');    
                }   
                else
                {
                    $_SESSION['error'] = $login ;
                    header ('Location: ../nouser.php');
                }
                
                    
            }
            else
            {
 
                header ('Location: ../index.php');
            }
            echo $_POST['login'];

//    }

?>
