<?php
    require './lib/functions.php';

    $cat = get_cat(); 
?>
<div id="nav">
    <?php
            foreach ($cat as $cate) {
        ?>
    <div style="background:<?php echo rand_col();?>;">
        <?php echo $cate['name'];
         ?>
    </div>
    <?php
    }
    ?>

</div>
