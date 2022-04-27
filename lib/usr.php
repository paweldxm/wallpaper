<span>Lista użytkowników (<b><?php
    @session_start();
    $bcon = fast_conn();
if (mysqli_connect_errno())
{
    echo "Brak połączenia z bazą MySQL";
}
else {
    $howq = "SELECT COUNT(ID) FROM users";
    $howw = mysqli_query($bcon,$howq);
    $how = mysqli_fetch_array($howw);
    $how = (int)$how[0];
    $howSite = (int)($how/20);
    
    $rest = $how%20;
    $i=0;
    $act=($_SESSION['usite']) * 20;

$list = "SELECT * FROM users LIMIT 20 OFFSET " . $act;
$result = mysqli_query($bcon,$list);
echo $how .'</b>): </span>';
echo '<table><tr><td>id</td><td>data</td><td>login</td><td></td><td></td>';

while($row = mysqli_fetch_array($result))

{
    $i++;
    $login = $row['login'];
    echo "<tr><td>" . $row['id'] . "</td><td>" . $row['date'] . "</td><td>" . $row['login'] . "</td><td> ";
    echo '<a href="edituser.php?id=' . $row['id'] . '        ">edytuj</a></td><td>' ;
        
    if ($_SESSION['login']!=$row['login'])
    {
        $who = 'usuń';
    }
    else
    {
        $who = 'usuń mnie';
    }
    ?>

    <a onclick="return confirm('Jesteś pewny, że chcesz usunąć dane?');" href="./remove_user.php/?id= <?php echo $row['id'] . '">' . $who . '</a></td></tr>';    
    
    }
    echo '</tr></table>';
    echo '<div id="flex">';
    
    if ($howSite==0) {
        echo 'Wszystkie wyniki';
    }
    if ($howSite>0) {
        if ((($_SESSION['usite'])<=$howSite) && $_SESSION['usite']>0) {
            echo '<a href="./lib/user-p.php">poprzednie </a> | ';
            }
        echo '[' . ($act + 1) . ' - ' . ($act + $i) .']';
        if ($howSite>0 && ($_SESSION['usite']<$howSite) && (($act+$i)<$how)) {
            echo ' |  <a href="./lib/user-n.php"> następne</a>';
            }
        }

    mysqli_close($bcon);
}
echo '</div><br></aside>';
require './layout/footer.php';
?>