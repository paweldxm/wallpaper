<?php
    $category = get_cat();
?>
<div id="nav">
    <?php
        foreach ($category as $cate) {
    ?>
    <div class="nav-cat <?php if($page === $cate['name']) { echo 'active'; }?>">
	<a href="./category-show.php?cat=<?php echo $cate['name'] .'">'. $cate['name']; ?></a>
    </div>
    <?php } ?>
</div>
