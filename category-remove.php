<?php
    session_start();
    $page = 'category'; 
    require './layout/header.php'; 
    if(!isset($_SESSION['status'])) {
        header('Location: ../index.php');
        exit();
    }
    if(isset($_GET['cat'])) {
        $cat = clean($_GET['cat']);
        $_SESSION['rcat'] = $cat;
        $img = show_cat($cat);
        if (empty($img)==true) {
            del_category($cat);
            unset($_SESSION['rcat']);
            header('Location: ./category.php');
            die;
        }
    }


    if(isset($_POST['remove'])){
        $r_cat = $_POST['remove'];
        $n_cat = $_SESSION['rcat'];
        $chngCat = "UPDATE files SET category=:rVal WHERE category=:nVal";
        $pdo = get_connection();
        $stmt = $pdo->prepare($chngCat);

        $stmt->bindParam(':rVal', $r_cat);
        $stmt->bindParam(':nVal', $n_cat);
        $stmt->execute();

        del_category($n_cat);
        $_SESSION['rcat'];
        header('Location: ./category.php');
        die;
    }
    
    ?>
        <aside>
            <form class="aside-form" action="./category-remove.php" method="POST" ENCTYPE="multipart/form-data">
            <div class="form">W bazie istnieją tapety z tą kategorią<br>
                <label>Wybierz nową kategorię dla nich.</label>
                <select class="form" name="remove" required>
                    <option selected disabled>Katogire</option>
                    <?php
                        $list = get_cat();
                        foreach ($list as $result) {
                            if (!($result['name'] ==  $_SESSION['rcat'])) { 
                                echo "<option>" . $result['name'] . "</option>"; 
                            }
                        }   
                    ?>
                </select>
            </div>
            <br>
            <button  class="btn"type="submit">Wyślij</button>
        </form>
    </aside>

<?php
    require './layout/footer.php';
?>
