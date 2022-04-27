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
    // $_SESSION['site'] = 0;

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
    <span>Lista tapet w bazie (aktualnie <b>
        <?php
    $bcon = fast_conn();
    if (mysqli_connect_errno())
    {
        echo "Nie można się połączyć z bazą";
    }
    else {
    $howq = "SELECT COUNT(id) from files";
    $howw = mysqli_query($bcon,$howq);
    $how = mysqli_fetch_array($howw);
    // var_dump($how);die;
    $how = (int)$how[0];
    $howSite = (int)($how/20);
    $rest = $how%20;
    $i=0;
    $act=($_SESSION['site']) * 20;


    $list = "SELECT id, date, name, file  FROM files LIMIT 20 OFFSET " . $act;
    $result = mysqli_query($bcon,$list);
    echo $how .'</b>): </span>';
        echo '<table id="files"><tr><td>id</td><td>data dodania</td><td>nazwa tapety(plik)</td><td></td><td></td>';
        while($row = mysqli_fetch_array($result))
        {
            $i++;
            echo "<tr><td>" . $row['id'] ."</td><td>" ;
            echo $row['date'] . "</td>";
            echo '<td class="file">';
            echo $row['name'] ;
            ?>
    <div class="hidden">
        <?php
            echo '<img src="./uploads/mini/';
            echo $row['file'];
            echo '"/><br>';
            echo $row['file'];
        ?>
    </div>

    <?php
        echo '</td><td><a href="editwall.php?id=' . $row['id'] . '        ">edytuj</a></td>
    <td>' ;
        ?>
    <a onclick="return confirm('Jesteś pewny, że chcesz usunąć tapetę?');" href="./remove_file.php/?id=<?php echo $row['id'] . '">usuń</a></td></tr>';    
        }
    echo '</tr></table>';
    echo '<div id="flex">';
    
    if ($howSite==0) {
        echo 'Wszystkie wyniki';
    }
    if ($howSite>0) {
        if ((($_SESSION['site'])<=$howSite) && $_SESSION['site']>0) {
            echo '<a href="./lib/wallpap-p.php">poprzednie </a> | ';
            }
        echo '[' .$act + 1 . ' - ' . $act + $i .']';
        if ($howSite>0 && ($_SESSION['site']<$howSite) && (($act+$i)<$how)) {
            echo ' |  <a href="./lib/wallpap-n.php"> następne</a>';
            }
        }
    mysqli_close($bcon);
    }
    echo '</div>';
echo'</aside><br>';
require './layout/footer.php';
?>
