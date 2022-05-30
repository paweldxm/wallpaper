<?php 
    session_start();	
    $page = 'users';	    
    require './layout/header.php'; 

    if(!isset($_SESSION['status'])) {
        header('Location: ./index.php');
        exit();
    }
    if(isset($_GET['id'])) {
        $id = clean($_GET['id']);
        $stmt = show_user($id);
        $_SESSION['editid'] = $id;
        $_SESSION['editlogin'] = $stmt['login'];
    }
    if(isset($_POST['login'])) {
        $status = true;
        $login = $_POST['login'];
        $passwd = $_POST['passwd'];
        $passwd2 = $_POST['passwd2'];
        if ((strlen($login)<2) || (strlen($login)>20)) {
            $status = false;
            $_SESSION['e_login']='Login musi posiadać od 3 do 20 znaków!';
        }
        if (ctype_alnum($login)==false && strlen($login)>0) {
            $status = false;
            $_SESSION['e_login']='Login musi składać się tylko z liter i cyfr (bez polskich znaków)!';
        }
        if ((strlen($passwd)<3) || (strlen($passwd)>20)) {
            $status = false;
            $_SESSION['e_passwd']='Hasło musi posiadać od 3 do 20 znaków!';
        }
        if ($passwd!=$passwd2) {
            $status = false;
            $_SESSION['e_passwd2']='Podane hasła nie są identyczne!';
        }
        $passwd_hash = password_hash($passwd,PASSWORD_DEFAULT);
        try {
            $findUser = find_user($login);
            if($findUser==true) {
                $status = false;
                $_SESSION['e_login']='User '. $login .' już istnieje w bazie!';
            }
            else $error=false;
        }           
        catch(Exception $e) {
            echo'<span class="error">Błąd serwera! Zapraszamy później!</span>';
        }
        if($status==true) {
            $pdo = get_connection();
            if (isset($_SESSION['editid'])) {
                $add = "UPDATE users SET login=:loginVal, passwd=:passVal WHERE id = :idVal";
                $stmt = $pdo->prepare($add);
                $newId = $_SESSION['editid'];
                $stmt->bindParam(':idVal', $newId);
                $stmt->bindParam(':loginVal', $login);
                $stmt->bindParam(':passVal', $passwd_hash); 
                $stmt->execute();
                unset($_SESSION['editid']);
            }
            else {
                $add = 'INSERT INTO users(id, login, passwd, date) VALUES(null,:loginVal,:passVal,CURRENT_TIMESTAMP)' ;
                $stmt = $pdo->prepare($add);
                $stmt->bindParam(':passVal', $passwd_hash);
                $stmt->bindParam(':loginVal', $login);
                $stmt->execute();
            }

            unset($status);
            header ('Location: ./users.php');
            exit();
        }
    }
    if(isset($_GET['id'])) require './layout/users/edit.php'; 
    else require './layout/users/add.php'; 
    if (isset($_SESSION['e_login'])) {
        echo '<div class="error">'.$_SESSION['e_login'].'</div>';
        unset($_SESSION['e_login']);
    }
    if (isset($_SESSION['e_passwd2'])) {
        echo '<div class="error">'.$_SESSION['e_passwd2'].'</div>';
        unset($_SESSION['e_passwd2']);
    }
    if (isset($_SESSION['e_passwd'])) {
        echo '<div class="error">'.$_SESSION['e_passwd'].'</div>';
        unset($_SESSION['e_passwd']);
    }
    echo '<br>';

    if(!isset($_GET['id'])) require './lib/usr.php';
    else {
        echo '</div><br></aside>';
        require './layout/footer.php';
        exit();
    }
?>

