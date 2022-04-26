<?php
    @session_start();
    $cat = get_cat();
    
?>
<div id="nav">
    <?php
            foreach ($cat as $cate) {
                // var_dump($_SESSION['acat']);die;

        ?>

    <div id="sub">

        <a href="./index-cat.php?cat=<?php 

                echo $cate['name'] .'">';

                if (isset($_SESSION['acat']) && ($_SESSION['acat']==$cate['name'])) {
                    echo '<span class="active">';
                    echo $cate['name'];
                    $_SESSION['acat'] = $cate['name'];
                    echo '</span>';
                    
                }
                else {
                    echo $cate['name'];
                }
                
                ?>
        </a>
    </div>
    <?php
    }
    ?>

</div>
