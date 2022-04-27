<?php
    @session_start();
    if(isset($_GET['cat']))
    {
        $_SESSION['acat']=$_GET['cat'];
    }
    require './layout/header.php';
    if(isset($_SESSION['status']))
    {
        require './layout/menu.php';
    }
    if (isset($_GET['cat'])) {
        $cat=$_GET['cat'];
        $_SESSION['acat']=$cat;
        $result = show_cat($cat);
        if ($result[0] == 0) {
            header ('Location: ./index.php');
            die;
            }
        }
    if (isset($_SESSION['jump']) && ($_SESSION['jump']>0)) {
        $act=$_SESSION['jump'];
    }
    else {
        $_SESSION['jump']=0;
        $act=0;
    } 
    $bcon = fast_conn();
    // $find = 'SELECT id,file,category,width,res FROM files' ;
    $find = "SELECT id,file,res,width FROM files where category='" .$_SESSION['acat'] ."'";

    $result = mysqli_query($bcon,$find);
    $y=0;
    while($row[$y] = mysqli_fetch_array($result)){
        $y++;
    }
    // $cat = "wszystko";
    $rest = $y%20;
    $howMuch = (int)($y/20);
    if (isset($_SESSION['jump']) && (($_SESSION['jump'])>$howMuch)) {
        $_SESSION['jump'] = 0 ;
        header ('Location: ./index-cat.php');
        die;

    }
    ?>

    <aside>
    <div class="title">
        <?php echo $_SESSION['acat'] ; ?>
    </div>
    <div id="mini">
        <?php

    if ($y<=20) {
        for ($j=1; $j<=$y; $j++)
        {
            $z=($j)-1;
            $file = './uploads/' .$row[$z]['file'] ;
            $size = sizeMB($file);
            $x = $row[$z]['id'];
            echo '<div class="mini">';
            echo '<a href="./show.php?id='.$x.'">';
            echo '<img src="./uploads/mini/' . $row[$z]['file'] .'"></a>';
            echo '<div class="hidden">';
            echo '<ul>Informacje o pliku,<li>rozdzielczość: ' . $row[$z]['res'] .'</li><li>wielkość pliku: '.$size.'</li></ul></div></div>';
        }
        $act=0;
        exit();
    }
    else {
            $mx=21;
            $n=20*$act;
    
            for ($j=1; $j<$mx; $j++)
                    {
                    $xx=$j+$n;
                    $z=($j+$n)-1;
            $file = './uploads/' .$row[$z]['file'] ;
            $size = sizeMB($file);
            $x = $row[$z]['id'];
            echo '<div class="mini">';
            echo '<a href="./show.php?id='.$x.'">';
            echo '<img src="./uploads/mini/' . $row[$z]['file'] .'"></a>';
            echo '<div class="hidden">';
            echo '<ul>Informacje o pliku,<li>rozdzielczość: ' . $row[$z]['res'] .'</li><li>wielkość pliku: '.$size.'</li></ul></div></div>';
                    if ($xx==$y) {
                        echo'<br>';
                        break;
                        }
                    }

            echo '</div><div id="catl">'       ;
            if (($act==0 && ($act<$howMuch)))
            {
                echo '['. ($n + 1) .' - '. ($n - 1) + $j .']   |  ';
                echo '<a href="./lib/nx.php">następna</a>';
                echo '</div></aside>';
                require './layout/footer.php';
                exit();

            }
            if (($act==1 && ($act==$howMuch)) || ($act>1 && ($act=$howMuch))) {
                echo '<a href="./lib/px.php">poprzednia</a>';
                echo '  |  ['. ($n + 1) .' - '. ($n - 1) + $j .'] ';
                echo '</div></aside>';
                require './layout/footer.php';
                exit();
            }
            if ($act==1 && ($act<$howMuch)) {
                echo '<a href="./lib/px.php">poprzednia</a>';
                echo '  |  ['. ($n + 1) .' - '. ($n - 1) + $j .']  |  ';
                echo '<a href="./lib/nx.php">następna</a>';
                echo '</div></aside>';
                require './layout/footer.php';
                exit();
            }
            if ($act>1 && ($act<=$howMuch)) {
                echo '<a href="./lib/px.php">poprzednia</a>';
                echo '['. ($n + 1) .' - '. ($n - 1) + $j .']';
                echo '<a href="./lib/nx.php">następna</a>';
                echo '</div></aside>';
                require './layout/footer.php';
                exit();
            }
        }
            
   
 echo '</div></aside>';
    
require './layout/footer.php'; ?>
    