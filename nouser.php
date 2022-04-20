<?php 
    @session_start();

require './layout/header.php'; 
?>

<h4 class="red">NIE MA TAKIEGO UŻYTKOWNIKA <b>
        <?php
        echo $_SESSION['error'] . '</b> LUB HASŁO JEST NIEPOPRAWNE';
    
    ?>
</h4><br>
<?php
require './layout/footer.php';
?>
