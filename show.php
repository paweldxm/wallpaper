<?php require './layout/header.php';
    @session_start();
    if(isset($_SESSION['status']))
        {
            require './layout/menu.php';
        }
    $id = $_GET['id'];
    $img = show_img($id);
?>
<aside class="show">
    <div id="small" class="img">
        <img src="./uploads/small/<?php echo $img['file'];?>" />
        <?php
            $file = './uploads/' .$img['file'] ;
            $size = sizeMB($file);
            echo '<div class="hidden">';
            echo '<ul>Informacje o pliku,<li>rozdzielczość: ' . $img['res'] .'</li><li>wielkość pliku: '.$size.'</li></ul></div>';

        ?>
    </div>
    <div class="cat">
        Kategoria: <br><?php echo $img['category'];?>
    </div>
    <div class="nam">
        Tytuł: <br>
        <?php echo $img['name'];?>
    </div>
    <div class="con">
        Opis: <br>
        <?php echo $img['content'];?>
    </div>
    <div class="down">
        <a class="btn" href="./uploads/<?php echo $img['file'];?>" download="./uploads/<?php echo $img['file'];?>">Pobierz</a>
    </div>
</aside>

<?php require './layout/footer.php'; ?>
