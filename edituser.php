<?php 
    @session_start();
    if(!isset($_SESSION['status']))
    {
        header('Location: ./index.php');
        exit();
    }
    
    require './layout/header.php'; 
    require './layout/menu.php'; 

    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $pdo = get_connection();
        $query = 'select * from users WHERE ID=' . $id  ;

        $result = $pdo->query($query);
        $stmt = $result->fetch();
        $_SESSION['editid'] = $id;
        $_SESSION['editlogin'] = $stmt['login'];    
    }


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
            $_SESSION['e_passwd2']='Podane hasła nie są identyczne';
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
                        $_SESSION['e_login']='User istnieje!';
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
            $edit = "UPDATE users SET login='$login' WHERE id= " .$_SESSION['editid'];
            $pdo->query($edit);
            header ('Location: ./users.php');
            exit();
            }
    }
?>
<aside>
    <div>
        <h3>EDYTUJ UŻYTKOWNIKA
            <?php
                echo ' <b><u>' . $_SESSION['editlogin'] . '</u></b>';
            
            ?>
        </h3>
        <form action="edituser.php" method="POST" ENCTYPE="multipart/form-data">
            <div>
                <label for="login">Zmień login</label>
                <input type="text" name="login" />
            </div>
            <div>
                <label for="passwd">Zmień hasło</label>
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
    <span>Lista obecnych użytkowników:</span>
    <?php
        $bcon = fast_conn();
if (mysqli_connect_errno())
{
    echo "Nie można się połączyć z bazą";
}
else {
echo '<table><tr><td>id</td><td>data</td><td>login</td><td></td><td></td>';

$result = mysqli_query($bcon,"SELECT * FROM users");

while($row = mysqli_fetch_array($result))

{
    $login = $row['login'];
    echo "<tr><td>" . $row['id'] . "</td><td>" . $row['date'] . "</td><td>" . $row['login'] . "</td><td> ";
    echo '<a id="showEd" href="javascript:showE();">edytuj</a></td><td>' ;
        
    if ($_SESSION['login']!=$row['login'])
    {
        $who = 'usuń';
    }
    else
    {
        $who = '<span class="red">usuń mnie</span>';
    }

    ?>

    <a onclick="return confirm('Jesteś pewny, że chcesz usunąć dane?');" href="./remove_user.php/?id= <?php echo $row['id'] . '">' . $who . '</a></td></tr>';    
    
    }
    echo '</tr></table>';
    mysqli_close($bcon);
}
echo '<br><br>';
echo '</aside>';
require './layout/footer.php';
?>
