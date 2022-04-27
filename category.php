<?php
    @session_start();
    if(!isset($_SESSION['status']))
    {
        header('Location: ./index.php');
        exit();
    }
    if(isset($_SESSION['acat']))
    {
        $_SESSION['acat']=null;
    }
    if(!isset($_SESSION['csite'])){
        $_SESSION['csite'] = 0;
    }
    require './lib/functions.php';
    require './layout/header.php';
    require './layout/menu.php'; 

        if(isset($_POST['name'])){
            $status = true;
            $name = $_POST['name'];
            $a = strlen($name);
            if (($a<2) || ($a>20)) 
                {
                    $status = false;
                    $_SESSION['e_cat']='Kategoria musi posiadać co najmniej 3 znaki!';
                } 
            try {
            $pdo = get_connection();
            $catn = "SELECT * FROM category WHERE name='$name'";
            $result1 = $pdo->query($catn);
            $row1 = $result1->fetch(); 
            if($row1==true)
                    {
                        $status = false;
                        $_SESSION['e_cat']='Taka kategoria już istnieje!';
                    }
            }
            catch(Exception $e)
            {
                echo'<span class="error">Błąd serwera! Zapraszamy później!</span>';
                echo '<br/>Informacja developerska: '.$e;
            }
            if($status==true) {
                $pdo = get_connection();
                $add = "INSERT INTO category VALUES(null,'$name',CURRENT_TIMESTAMP)" ;
                $pdo->query($add);
                header ('Location: ./category.php');
                exit();
            }
        }
?>

<aside>
    <a id="showMe" href="javascript:show();">
        <h3>DODAJ NOWĄ KATEGORIĘ</h3>
    </a>
    <div id="hideMe" style="display: none;">
        <form action="category.php" method="POST" ENCTYPE="multipart/form-data">
            <div>
                <label>Nazwa kategori</label>
                <input type="text" name="name" />
            </div>
            <button type="submit">Wyślij</button>
        </form>
    </div>
    <br><br>
    <?php
    require './lib/cat.php';
