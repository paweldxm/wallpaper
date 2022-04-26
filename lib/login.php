<?php
    @session_start();
    require 'functions.php';
    
 if (!isset($_POST)) {
        header ('Location: ../index.php');
        exit();
        }
        
            
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
                    die;
                }
                if(password_verify(($passwd),$row['passwd']))
                {
                    $_SESSION['status']= true;
                    $_SESSION['login'] = $row['login'];
                    unset($_SESSION['error']);
                    header ('Location: ../index.php');    
                }   
                else
                {
                    $_SESSION['error'] = $login ;
                    header ('Location: ../nouser.php');
                    die;

                }
                
                    
            }
            else
            {
 
                header ('Location: ../nouser.php');
                exit();
            }
        header ('Location: ../index.php');
        exit();

 

?>
