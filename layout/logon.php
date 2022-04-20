<?php 
@session_start();
?>
<form class="menu" action="./lib/login.php" method="post">
    <div class="formc">
        <input type="text" class="formc" placeholder="login" name="login">
    </div>
    <div class="formc">
        <input type="password" placeholder="password" name="passwd" class="formc">
    </div>
    <div>
        <button class="formc" type="submit" value="log-in">Zaloguj</button>
    </div>
</form>
