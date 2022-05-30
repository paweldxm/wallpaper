<?php
    session_start();
    require './layout/header.php';
?>

<aside>
    <div class="title">
        Najnowsze tapety
    </div>
    <div class="mini-in">
        <?php
            $result = show('new');
            require './lib/list.php';
        ?>

    </div>
    <div class="title">
        Tapety o największej rozdzielczości
    </div>
    <div class="mini-in">

        <?php
            $result = show('max');
            require './lib/list.php';
        ?>

    </div>
    <br>
</aside>

<?php
    require './layout/footer.php';
?>