<?php 
    session_start();	
    $page = 'users';	    
    require './layout/header.php'; 

    if(!isset($_SESSION['status'])) {
        header('Location: ./index.php');
        exit();
    }
?>
<aside>
    <form class="aside-form" action="./users.php" method="POST" ENCTYPE="multipart/form-data">
        <div class="form">
            <label for="login">Podaj login</label>
            <input type="text" name="login" required/>
        </div>
        <div class="form">
            <label for="passwd">Podaj hasło</label>
            <input type="password" name="passwd" required/>
        </div>
        <div class="form">
            <label for="passwd">Powtórz hasło</label>
            <input type="password" name="passwd2" required/>
        </div>
        <br>
        <button class="btn" type="submit">Wyślij</button>
        <br>
    </form>    
</aside>
<?php
    require './layout/footer.php';
