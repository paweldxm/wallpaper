<?php 
    session_start();
    $page = 'wallpap';
    if(!isset($_SESSION['status'])) {
        header('Location: ./index.php');
        exit();
    }

    require './layout/header.php'; 

    if(isset($_GET['id'])) {
        $id = clean($_GET['id']);
        $stmt = show_img($id);
        $catold = $stmt['name'];    
        $_SESSION['editcat'] = $catold;
        $_SESSION['editid']=$id;
        $_SESSION['editimg']=$stmt['file'];
    }
    if(isset($_POST['name'])) {
        $pdo = get_connection();
        $newid=$_SESSION['editid'];
        $newname = clean($_POST['name']);
        $newcategory = $_POST['category'];
        $newcontent = clean($_POST['content']);
        $catt2 = $_SESSION['editcat'];

        if (strcmp($_POST['name'],$newname) != 0) {
            $newname = 'w nazwie były niedozwolone znaki';
        }
        if (strcmp($_POST['content'],$newcontent) != 0) {
            $newcontent = 'w opisie były niedozwolone znaki';
        }
        $edit = "UPDATE files SET name=:newnameVal ,category=:newcatVal ,content=:newcontentVal WHERE id= :newidVal";
        
        $stmt = $pdo->prepare($edit);
        $stmt->bindParam(':newnameVal', $newname);
        $stmt->bindParam(':newcatVal', $newcategory);
        $stmt->bindParam(':newcontentVal', $newcontent);
        $stmt->bindParam(':newidVal', $newid);
        
        $stmt->execute();
        
        header('Location: ./wallpaper.php');
        exit();
    }

?>
<aside>
    <div>
        <h3>EDYTUJ TAPETĘ
            <?php
                echo ' <b><u>' . $id . '</u></b><br><i>' . $_SESSION['editcat'] .'</i>';
            ?>
        </h3>
        <div>
            <form class="aside-form" action="./wallpaper-edit.php" method="POST" ENCTYPE="multipart/form-data">
                <div class="all">
                    <?php
                        echo '<img src="./uploads/small/';
                        echo $_SESSION['editimg'];
                        echo '"/><br>';
                    ?>
                </div>
                <div class="form">
                    <label required>Zmień nazwę</label>
                    <input type="text" name="name" required/>
                </div>
                <div class="form">
                    <label required>Zmień opis</label>
                    <input type="text" name="content" required/>
                </div>
                <div class="form">Wybierz kategorię<br>
                    <select class="form" name="category" required>
                        <option selected disabled>Katogire</option>
                            <?php
                                $cat = get_cat();
                                foreach ($cat as $cate) echo "<option>" . $cate['name'] . "</option>";
                            ?>
                    </select>
                </div>
                <br>
                <button class="btn" name="submit" type="submit">Wyślij</button>
            </form>
        </div>
    </div>
    <br><br>
</aside>
<?php require './layout/footer.php'; ?>
