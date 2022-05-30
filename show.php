<?php
    session_start();

    if((array_key_exists('id', $_GET)) && is_int((int)$_GET['id'])) {
        $id = (int)$_GET['id'];
    }
    else {
        header('Location: ./index.php');
        die;
    }
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = mysqli_connect("localhost","ucsxgcvewm_pawel","-IpkLD2vS6ql-T0]","ucsxgcvewm_wallpaper");
    $query = sprintf("SELECT * FROM files WHERE id = %s", $mysqli->real_escape_string($id));
    $result = $mysqli->query($query);
    $img = mysqli_fetch_array($result);
    if($img==false) {
        header('Location: /index.php');
        die;
    }
    $_SESSION['meta'] = $img['name'];
    $_SESSION['content'] = $img['content'];

    require './layout/header.php';
    $id = clean($_GET['id']);
    $img = show_img($id);
    
    $file = "./uploads/" .$img['file'] ;
    $size = sizeMB($file);

?>
<aside class="show">
    <!-- <div> -->
        <div class="title">
            Tapeta #<b><?php echo $id; ?></b>
        </div>
        <div class="left">
            <div id="small" class="img">
                <img src="./uploads/small/<?php echo $img['file'];?>">
            </div>
        </div>
        <div class="right">
            <div class="cat">
                <span class="all"><b>Kategoria:</b> <br><?php echo $img['category'];?></span>
            </div>
            <div class="nam">
                <span class="all"><b>Tytuł:</b><br>
                <?php echo $img['name'];?></span>
            </div>
            <div class="con">
            <span class="all"><b>Opis:</b><br>
                <?php echo $img['content'];?></span>
            </div>
            <div class="inf">
                <span class="all"><b>Informacje o pliku:</b><br>
                    <li>rozdzielczość: <b><?php echo $img['res'];?></b></li>
                    <li>wielkość pliku: <b><?php echo $size ;?></b></li>
                </span>
            </div>
        </div>
    <!-- </div>  -->
    <div class="down">
        <div class="show-left">
            <a class="btn" href="./uploads/<?php echo $img['file'];?>" download="./uploads/<?php echo $img['file'];?>">Pobierz</a>
        </div>
        <div class="show-right">
        </div>
    </div>
</aside>


<?php
    unset($_SESSION['meta']);
    unset($_SESSION['content']);
    require './layout/footer.php';
    



