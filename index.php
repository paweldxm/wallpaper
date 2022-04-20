<?php
    @session_start();
    require './layout/header.php';
    if(isset($_SESSION['status']))
    {
        require './layout/menu.php';
    }
?>

<aside>
    <div class="title">
        Najnowsze tapety
    </div>
    <div id="small">
        <div class="small">1</div>
        <div class="small">2</div>
        <div class="small">3</div>
        <div class="small">4</div>
        <div class="small">5</div>
        <div class="small">6</div>
        <div class="small">7</div>
        <div class="small">8</div>
    </div>
    <div class="title">
        Tapety o największej rozdzielczości
    </div>
    <div id="small">
        <div class="small">1</div>
        <div class="small">2</div>
        <div class="small">3</div>
        <div class="small">4</div>
        <div class="small">5</div>
        <div class="small">6</div>
        <div class="small">7</div>
        <div class="small">8</div>
    </div>
</aside>

<?php require './layout/footer.php'; ?>
