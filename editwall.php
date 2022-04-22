<?php 
    @session_start();
    if(!isset($_SESSION['status']))
    {
        header('Location: ./index.php');
        exit();
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
    <span>Lista tapet w bazie:</span>
    <?php
    $bcon=mysqli_connect("localhost","root","","wallpaper");
    if (mysqli_connect_errno())
    {
        echo "Nie można się połączyć z bazą";
    }
    else {
        echo '<table id="files"><tr><td>id</td><td>data dodania</td><td>nazwa tapety(plik)</td><td></td><td></td>';
        $result = mysqli_query($bcon,"SELECT * FROM files");
        while($row = mysqli_fetch_array($result))
        {
            echo "<tr><td>" . $row['id'] ."</td><td>" ;
            echo $row['date'] . "</td>";
            echo '<td class="file">';
            echo $row['name'] ;
            ?>
    <div class="hidden">
        <?php echo $row['file'];?>
    </div>

    <?php
        echo '</td><td><a href="editwall.php?id=' . $row['id'] . '        ">edytuj</a></td>
    <td>' ;
        ?>
    <a onclick="return confirm('Jesteś pewny, że chcesz usunąć tapetę?');" href="./remove_file.php/?id=<?php echo $row['id'] . '">usuń</a></td></tr>';    
        }
    echo '</tr></table>';
    mysqli_close($bcon);
    }
echo'<br></aside>';
require './layout/footer.php';
       ?>
