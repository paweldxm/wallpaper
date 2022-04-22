<?php
    $cat = get_cat(); 
    ?>
<div id="nav">
    <?php
            foreach ($cat as $cate) {
        ?>

    <div id="sub">

        <a href="./index-cat.php?cat=<?php 
                echo $cate['name'] ?>">
            <?php echo $cate['name'];?>
        </a>
    </div>
    <?php
    }
    ?>

</div>
