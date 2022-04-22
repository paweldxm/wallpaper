<?php 
@session_start();
?>
<div class="menu">
    <div style="margin-right:10px;   justify-content: center;">
        <?php
        echo '<b>';

        echo $_SESSION['login'] ;
    
        echo ' </b> ';

    ?>
    </div>
    <a href="./kill.php" class="btn">Wyloguj się</a>
</div>
