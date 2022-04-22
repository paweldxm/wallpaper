<?php
    @session_start();
    require './layout/header.php';
    if(isset($_SESSION['status']))
    {
        require './layout/menu.php';
    }

//    $bcon=mysqli_connect("localhost","root","","wallpaper"); 
//    $result = mysqli_query($bcon,$find);
    if (isset($_GET['cat'])) {
        $cat=$_GET['cat'];
        $result = show_cat($cat);
        
        var_dump(show_cat($cat));
        die;
    }
    else {
        header ('Location: ./index.php');
        die;
    }
?>

<aside>
    <div class="title">
        <?php echo $cat ; ?>
    </div>
    <div id="mini">
        <?php
        $bcon=mysqli_connect("localhost","root","","wallpaper"); 
        $find = 'SELECT file,res FROM files WHERE category="'.$cat.'" ORDER BY files.date DESC';
        $result = mysqli_query($bcon,$find);
        
        while($row = mysqli_fetch_array($result)) {
            $file = './uploads/' .$row['file'] ;
            $size = sizeMB($file);
            echo '<div class="mini">';
                echo '<img src="./uploads/mini/' . $row['file'] .'">';
                echo '<div class="hidden">';
                echo '<ul>Informacje o pliku,<li>rozdzielczość: ' . $row['res'] .'</li><li>wielkość pliku: '.$size.'</li></ul></div></div>';

        }
  
    ?>
    </div>
</aside>

<?php require './layout/footer.php'; ?>
