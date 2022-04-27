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
    require './layout/header.php'; 
    require './layout/menu.php'; 

    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $pdo = get_connection();
        $query = "SELECT * FROM files WHERE id= ".$id;
        $result = $pdo->query($query);
        $stmt = $result->fetch();
        $catold = $stmt['name'];    
        $_SESSION['editcat'] = $catold;
        $_SESSION['editid']=$id;
        $_SESSION['editimg']=$stmt['file'];
    }
    if(isset($_POST['name'])) {
                $pdo = get_connection();
                $newid=$_SESSION['editid'];
                $n = $_POST['name'];
                $ct = $_POST['category'];
                $co = $_POST['content'];
                $catt2 = $_SESSION['editcat'];
                $edit = "UPDATE files SET name='$n',category='$ct',content='$co' WHERE id= ".$newid;
                $pdo->query($edit);

                header('Location: ./wallpap.php');
                die;
                }

?>
<aside>
    <div>
        <h3>EDYTUJ TAPETĘ
            <?php
                echo ' <b><u>' . $_SESSION['editcat'] . '</u></b>';
            
            ?>
        </h3>
        <div class="edit">
            <div>
                <?php
                    echo '<img src="./uploads/mini/';
                    echo $_SESSION['editimg'];
                    echo '"/><br>';
                ?>
            </div>
            <div>
                <form action="./editwall.php" method="POST" ENCTYPE="multipart/form-data">
                    <div>
                        <label required>Zmień nazwę</label>
                        <input type="text" name="name" />
                    </div>
                    <div>
                        <label required>Zmień opis</label>
                        <input type="text" name="content" />
                    </div>
                    <div>Wybierz kategorię<br>
                        <select name="category" size="5">
                            <?php
                        $cat = get_cat();
                           foreach ($cat as $cate) {

                               echo "<option>" . $cate['name'] . "</option>";

                           }
                
                    ?>
                        </select>
                    </div>
                    <button type="submit">Wyślij</button>
                </form>
            </div>
        </div>

    </div>
    <br><br>
    <?php
        require './lib/wall.php';
    ?>