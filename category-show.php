<?php 
    session_start();
    if (isset($_GET['cat'])) {
	    $_SESSION['acat'] = htmlentities($_GET['cat'], ENT_QUOTES | ENT_IGNORE, "UTF-8");
	    $page = $_SESSION['acat'];
    }

    require './layout/header.php';
    

    if (isset($_GET['cat'])) {
        $cat=clean($_GET['cat']);
        $result = show_cat($cat);
        if ($result[0] == 0) {
            header ('Location: ./index.php');
            die;
        }
        $_SESSION['acat']=$cat;
    }
    
    $bcon = fast_conn();
    $find = "SELECT * FROM files where category='" .$_SESSION['acat'] ."'";

    $result = mysqli_query($bcon,$find);

    $total = mysqli_num_rows($result);
    $per_page = 20;
    $cur_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $skip = (($cur_page - 1) * $per_page);

    $howMuch = ceil($total / $per_page);
    $find .= " LIMIT $skip, $per_page";

    $result = mysqli_query($bcon, $find);
?>

<aside>
    <div class="title"><br>
        <b>
           <?php echo $_SESSION['acat'] ; ?>
        </b>
    </div>
    <div class="mini-in">
        <?php require './lib/list.php'; ?>
    </div>
    <?php
    if ($howMuch == 1)  echo '<ul class="pagination"><li><a class="active" href="./category-show.php?cat='. $_SESSION['acat'] . '">1</a></li></ul>';
    if ($howMuch > 1) {
        echo '<ul class="pagination">';
        echo generate_page_links($cur_page, $howMuch);
        echo '</ul>';
    }
    mysqli_close($bcon);

    echo '<br></div><br></aside>';
    require './layout/footer.php';
?>
    