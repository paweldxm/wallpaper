<?php
    @session_start();
    require './layout/header.php';
    if(isset($_SESSION['status']))
    {
        require './layout/menu.php';
    }
?>

<aside>
    <div class="title">
        Najnowsze tapety
    </div>
    <div id="mini">
        <?php
        $bcon = fast_conn();
        $find = 'SELECT file,res,id FROM files ORDER BY files.date DESC LIMIT 8' ;
        $result = mysqli_query($bcon,$find);
        
        while($row = mysqli_fetch_array($result)) {
            $file = './uploads/' .$row['file'] ;
            $size = sizeMB($file);
            echo '<div class="mini">';
            echo '<a href="./show.php?id='.$row['id'].'">';
            echo '<img src="./uploads/mini/' . $row['file'] .'"></a>';
            echo '<div class="hidden">';
            echo '<ul>Informacje o pliku,<li>rozdzielczość: ' . $row['res'] .'</li><li>wielkość pliku: '.$size.'</li></ul></div></div>';

        }
  
    ?>

    </div>
    <div class="title">
        Tapety o największej rozdzielczości
    </div>
    <div id="mini">

        <?php
        $find2 = 'SELECT file,res,id FROM files ORDER BY files.width DESC LIMIT 8' ;
        $result2 = mysqli_query($bcon,$find2);
        
        while($row = mysqli_fetch_array($result2)) {
            $file = './uploads/' .$row['file'] ;
            $size = sizeMB($file);
            echo '<div class="mini">';
            echo '<a href="./show.php?id='.$row['id'].'">';
            echo '<img src="./uploads/mini/' . $row['file'] .'"></a>';
            echo '<div class="hidden">';
            echo '<ul>Informacje o pliku,<li>rozdzielczość: ' . $row['res'] .'</li><li>wielkość pliku: '.$size.'</li></ul></div></div>';

        }
        
        ?>

    </div>
</aside>

<?php require './layout/footer.php'; ?>
