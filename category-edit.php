<?php
    session_start();
    $page = 'category';
    require './layout/header.php';

    if(!isset($_SESSION['status'])) {
        header('Location: ./index.php');
        exit();
    }
    if(isset($_GET['id'])) {
        $id = clean($_GET['id']);
        $stmt = find_cat($id);
        $catold = $stmt['name'];    
        $_SESSION['editcat'] = $catold;
        $_SESSION['editid'] = $id;
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
            $_SESSION['check']=false;
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
            $pdo = get_connection();

            $newid=$_SESSION['editid'];
            $catt = clean($_POST['name']);
            $catt2 = $_SESSION['editcat'];

            $edit = "UPDATE category SET name=:catVal WHERE id = :newidVal";
            $stmt = $pdo->prepare($edit);

            $stmt->bindParam(':catVal', $catt);
            $stmt->bindParam(':newidVal', $newid);
            $stmt->execute();

            $edit2 = "UPDATE files SET category=:catVal WHERE category = :cattVal";
            $stmt = $pdo->prepare($edit2);

            $stmt->bindParam(':catVal', $catt);
            $stmt->bindParam(':cattVal', $catt2);
            $stmt->execute();

            unset($_SESSION['e_cat']);
            unset($_SESSION['editcat']);
            header ('Location: ./category.php');

            die;
        }  
    }
            
?>
<aside>
    <h3>EDYTUJ KATEGORIĘ
        <?php echo ' <b><u>' . $_SESSION['editcat'] . '</u></b>'; ?>
    </h3>
    <form class="aside-form" action="./category-edit.php" method="POST" ENCTYPE="multipart/form-data">
        <div class="form">
            <label>Zmień nazwę</label>
            <input type="text" name="name" required/>
        </div>
        <button class="btn" type="submit" name="submit">Wyślij</button>
    </form>

<?php
    if (isset($_SESSION['e_cat'])) {
        echo '<div class="error">'.$_SESSION['e_cat'].'</div>';
        unset($_SESSION['e_cat']);
    }
    echo '<br><br></aside>';
    require './layout/footer.php';
?>