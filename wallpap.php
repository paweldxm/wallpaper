<?php
    @session_start();
    if(!isset($_SESSION['status']))
    {
        header('Location: ./index.php');
        exit();
    }
    if(isset($_SESSION['acat']))
    {
        $_SESSION['acat']=null;
    }
    if(!isset($_SESSION['site'])){
        $_SESSION['site'] = 0;
    }

    require './layout/header.php';
    require './layout/menu.php';
?>

<aside>
    <a id="showMe" href="javascript:show();">
        <h3>DODAJ NOWĄ TAPETĘ</h3>
    </a>
    <div id="hideMe" style="display: none">
        <form action="upload.php" method="POST" ENCTYPE="multipart/form-data">
            <div>
                <input type="file" name="image">
            </div>
            <div>Wybierz kategorię<br>
                <select name="category" size="5">
                    <?php
                        $cat = get_cat();
                        foreach ($cat as $cate) {
                               echo "<option>" . $cate['name'] . "</option>";
                           }
                        echo '<option>brak</option>';
                        
                    ?>
                </select>
            </div>
            <div>
                <label>Nazwa tapety</label>
                <input type="text" name="name" />
            </div>
            <div>
                <label>Opis tapety</label>
                <input type="text" name="content" />
            </div>
            <button type="submit">Wyślij</button>
        </form>
    </div>
    <br><br>
    <?php
        require './lib/wall.php';
    ?>