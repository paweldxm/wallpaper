<?php
    session_start();
    $page = 'category';
    require './layout/header.php';

    if(!isset($_SESSION['status'])) {
        header('Location: ./index.php');
        exit();
    }
    if(isset($_POST['name'])){
        $status = true;
        $name = clean($_POST['name']);
        if ((strlen($name)<3) || (strlen($name)>20)) {
            $status = false;
            $_SESSION['e_cat']='Niepoprawna nazwa!';
        }
        if (strcmp($_POST['name'],$name) != 0) {
            $_SESSION['e_cat']='W nazwie mogą być tylko litery i cyfry!';
            $status = false;
        } 
        try {
            $result = show_category($name);
            if($result==true) {
                $status = false;
                $_SESSION['e_cat']='Taka kategoria już istnieje!';
            }
        }
        catch(Exception $e) {
            echo'<span class="error">Błąd serwera! Zapraszamy później!</span>';
        }
        if($status==true) {
            $name = strtolower($name);
            add_category($name);
            unset($status);
            unset($_SESSION['e_cat']);
            header ('Location: ./category.php');
            die;
        }
    }
?>
<aside>
    <form class="aside-form" action="./category-add.php" method="POST" ENCTYPE="multipart/form-data">
        <div class=form">
            <label>Nazwa kategorii</label>
            <input type="text" name="name" required/>
        </div>
        <button class="btn" type="submit">Wyślij</button>
    </form><br>
<?php
    if (isset($_SESSION['e_cat'])) {
       echo '<div class="error">'.$_SESSION['e_cat'].'</div>';
       unset($_SESSION['e_cat']);
    }
?>

<br><br></aside>
<?php
    require './layout/footer.php';
?>