<?php 
@session_start();
?>
<div class="menu">
    <div style="margin-right:10px;">
        Zalogowany jako:
        <?php
        echo '<b>';

        echo $_SESSION['login'] ;
    
        echo ' </b> ';

    ?>
    </div>
    <a href="./kill.php" class="btn btn-success">Wyloguj się</a>
</div>
