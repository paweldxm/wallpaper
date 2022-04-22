<?php
    @session_start();
    require './layout/header.php';
    if(isset($_SESSION['status']))
    {
        require './layout/menu.php';
    }
    if (isset($_GET['cat'])) {
        $cat=$_GET['cat'];
        $result = show_cat($cat);
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
                
        foreach($result as $row) {
            $file = './uploads/' .$row['file'] ;
            $size = sizeMB($file);
            $x = $row['id'];
            echo '<div class="mini">';
            echo '<a href="./show.php?id='.$x.'">';
            echo '<img src="./uploads/mini/' . $row['file'] .'">';
            echo '<div class="hidden">';
            echo '<ul>Informacje o pliku,<li>rozdzielczość: ' . $row['res'] .'</li><li>wielkość pliku: '.$size.'</li></ul></div></a></div>';

        }
  
    ?>
    </div>
</aside>

<?php require './layout/footer.php'; ?>
