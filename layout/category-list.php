<?php
    require './lib/functions.php';

    $cat = get_cat(); 
?>
<div id="nav">
    <?php
            foreach ($cat as $cate) {
        ?>
    <div class="cat<?php echo rand(1,count($cat));?>">
        <?php echo $cate['name'];
         ?>
    </div>
    <?php
    }
    ?>

</div>
