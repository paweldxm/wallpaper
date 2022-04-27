<span>Lista kategori w bazie (<b><?php
    @session_start();
    $bcon = fast_conn();
    if (mysqli_connect_errno())
    {
        echo "Nie można się połączyć z bazą";
    }
    else {
        $howq = "SELECT COUNT(ID) FROM category";
        $howw = mysqli_query($bcon,$howq);
        $how = mysqli_fetch_array($howw);
        $how = (int)$how[0];
        $howSite = (int)($how/20);
        
        $rest = $how%20;
        $i=0;
        $act=($_SESSION['csite']) * 20;
        $list = "SELECT * FROM category LIMIT 20 OFFSET " . $act;
        $result = mysqli_query($bcon,$list);
        echo $how .'</b>): </span>';
        echo '<table><tr><td>id</td><td>data dodania</td><td>nazwa</td><td></td><td></td>';

        while($row = mysqli_fetch_array($result))
        {
            $i++;
            echo "<tr><td>" . $row['id'] . "</td><td>" . $row['date'] . "</td><td>" . $row['name'] . "</td><td> ";
            echo '<a href="./editcat.php?id=' . $row['id'] . '        ">edytuj</a></td><td>' ;
            ?>
    <a onclick="return confirm('Jesteś pewny, że chcesz usunąć dane?');" href="./remove_cat.php/?id=<?php echo $row['id'] . '">usuń</a></td></tr>';    

            }
            echo '</tr></table>';
            echo '<div id="flex">';
        
            if ($howSite==0) {
                echo 'Wszystkie wyniki';
            }
            if ($howSite>0) {
                if ((($_SESSION['csite'])<=$howSite) && $_SESSION['csite']>0) {
                    echo '<a href="./lib/cat-p.php">poprzednie </a> | ';
                    }
                echo '[' . ($act + 1) . ' - ' . ($act + $i) .']';
                if ($howSite>0 && ($_SESSION['csite']<$howSite) && (($act+$i)<$how)) {
                    echo ' |  <a href="./lib/cat-n.php"> następne</a>';
                    }
                }
            mysqli_close($bcon);
        }
echo'<br></aside>';
require './layout/footer.php';
       ?>
