<?php 
@session_start();
?>
<div class="menu">
    <div class="error" style="margin-right:10px;   justify-content: center;">
        Jesteś zalogowany:<br>
        <?php
        echo '<b>';

        echo $_SESSION['login'] ;
    
        echo ' </b> ';

    ?>
    </div>
    <a href="./kill.php" class="btn btn-success">Wyloguj się</a>
</div>
