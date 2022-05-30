<?php 
    session_start();
    $page = 'wallpap';
    require './layout/header.php'; 

    if(!isset($_SESSION['status'])) {
        header('Location: ./index.php');
        exit();
    }

?>
<aside>
    <form class="aside-form" action="./upload.php" method="POST" ENCTYPE="multipart/form-data">
        <div class="form">
            <label for="file" class="form">Umieść plik graficzny</label>
            <input class="form" type="file" name="my_image" required>
        </div>
        <hr>
        <div class="form">Wybierz kategorię<br>
            <select class="form" name="category" required>
                <option selected disabled>Katogire</option>
                    <?php
                        $cat = get_cat();
                        foreach ($cat as $cate) echo "<option>" . $cate['name'] . "</option>";
                    ?>
            </select>
        </div>
        <div class="form">
            <label>Nazwa tapety</label>
                <input type="text" name="name" />
        </div>
        <div class="form">
            <label>Opis tapety</label>
            <input type="text" name="content" />
        </div>
        <button  class="btn"type="submit">Wyślij</button>
    </form>
</aside>

<?php
 require './layout/footer.php';
?>