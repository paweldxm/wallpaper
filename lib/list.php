<?php
    foreach($result as $row) {
        $file = 'uploads/' .$row['file'] ;
        $size = sizeMB($file);
        echo '<div class="mini">';
        echo '<a href="show.php?id='.$row['id'].'">';
        echo '<img src="./uploads/mini/' . $row['file'] .'"></a>';
        echo '<div class="hidden">';
        echo '<ul>Informacje o pliku,<li>rozdzielczość: ' . $row['res'] .'</li><li>wielkość pliku: '.$size.'</li></ul></div></div>';
    }
?>
  