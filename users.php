<?php 
    @session_start();
    if(!isset($_SESSION['status']))
    {
        header('Location: ./index.php');
        exit();
    }
    if(isset($_SESSION['acat']))
    {
        $_SESSION['acat']=null;
    }
    if(!isset($_SESSION['usite'])){
        $_SESSION['usite'] = 0;
    }
    require './layout/header.php'; 
    require './layout/menu.php'; 
    if(isset($_POST['login'])){
        $status = true;
        $login = $_POST['login'];
        $passwd = $_POST['passwd'];
        $passwd2 = $_POST['passwd2'];

        $a = strlen($login);
        if (($a<2) || ($a>20)) 
        {
            $status = false;
            $_SESSION['e_login']='Login musi posiadać od 3 do 20 znaków!';
        }
        if (ctype_alnum($login)==false && $a>0) 
        {
            $status = false;
            $_SESSION['e_login']='Login musi składać się tylko z liter i cyfr (bez polskich znaków)!';
        }
        if ((strlen($passwd)<3) || (strlen($passwd)>20)) 
        {
            $status = false;
            $_SESSION['e_passwd']='Hasło musi posiadać od 3 do 20 znaków!';
        }

        if ($passwd!=$passwd2) 
        {
            $status = false;
            $_SESSION['e_passwd2']='Podane hasła nie są identyczne!';
        }

        $passwd_hash = password_hash($passwd,PASSWORD_DEFAULT);
        try {
            $pdo = get_connection();
            $sqllogin = "SELECT * FROM users WHERE login='$login'";
            $result1 = $pdo->query($sqllogin);
            $row1 = $result1->fetch(); 
            if($row1==true)
                    {
                        $status = false;
                        $_SESSION['e_login']='User '. $login .' już istnieje w bazie!';
                    }

        }
        catch(Exception $e)
        {
            echo'<span class="error">Błąd serwera! Zapraszamy później!</span>';
            echo '<br/>Informacja developerska: '.$e;
        }
        if($status==true)
            {
            $pdo = get_connection();
            $add = "INSERT INTO USERS VALUES(null,'$login','$passwd_hash',CURRENT_TIMESTAMP)" ;
            $pdo->query($add);
            header ('Location: ./users.php');
            exit();
            }
    }
?>
<aside>
    <a id="showMe" href="javascript:show();">
        <h3>DODAJ NOWEGO UŻYTKOWNIKA</h3>
    </a>
    <div id="hideMe" style="display: none;">
        <form action="users.php" method="POST" ENCTYPE="multipart/form-data">
            <div>
                <label for="login">Podaj login</label>
                <input type="text" name="login" />
            </div>
            <div>
                <label for="passwd">Podaj hasło</label>
                <input type="password" name="passwd" />
            </div>
            <div>
                <label for="passwd">Powtórz hasło</label>
                <input type="password" name="passwd2" />
            </div>
            <button type="submit">Wyślij</button>
        </form>
    </div>

    <?php
                if (isset($_SESSION['e_login']))
                {
                    echo '<div class="error">'.$_SESSION['e_login'].'</div>';
                }
                if (isset($_SESSION['e_passwd2']))
                {
                    echo '<div class="error">'.$_SESSION['e_passwd2'].'</div>';
                    unset($_SESSION['e_passwd2']);
                }
                if (isset($_SESSION['e_passwd']))
                {
                    echo '<div class="error">'.$_SESSION['e_passwd'].'</div>';
                    unset($_SESSION['e_passwd']);
                }
                ?>
    <br><br>
    <?php
    require './lib/usr.php';
    ?>
