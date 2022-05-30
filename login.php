<?php
    session_start();
    if(isset($_SESSION['status'])) {
        header('Location: ./index.php');
        exit();
    }
    require './layout/header.php'; 
    if (isset($_GET['error'])){
        echo '<aside><div class="non aside-form">';
        echo '<h4>Wystąpił błąd</h4>';
        if (isset($_SESSION['error'])) {
            echo '<h4 class="error">UŻYTKOWNIK <b>';
            echo $_SESSION['error'] . '</b> NIE ISTNIEJE LUB HASŁO JEST NIEPOPRAWNE';
            echo '</h4><br>';
            unset ($_SESSION['error']);
        }
        echo '<a class="btn" href="javascript:history.go(-1);">powrót</a>';
        echo'</div></aside>';
        require './layout/footer.php';
        exit();
    }
    
?>
<aside>
    <form class="aside-form" action="./lib/login.php" method="post">
        
        <div class="form">
            <label for="login">Podaj login</label>
            <input type="text" placeholder="login" name="login" required>
        </div>
        
        
        <div class="form">
            <label for="passwd">Podaj hasło</label>
            <input type="password" placeholder="password" name="passwd" required>
        </div>
        <div>
            <button class="btn" type="submit" value="log-in">Zaloguj</button>
        </div>
    </form>
</aside>
<br><br>
 <?php
    require './layout/footer.php';