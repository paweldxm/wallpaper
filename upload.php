<?php
    @session_start();
    if(!isset($_SESSION['status']))
    {
        header('Location: ./index.php');
        exit();
    }

    require './lib/functions.php';
    
    if (is_uploaded_file($_FILES['image']['tmp_name'])) {
            echo 'Odebrano image. Początkowa nazwa: '.$_FILES['image']['name'];
            echo '<br/>';
            if (isset($_FILES['image']['type'])) {
                echo 'Typ: '.$_FILES['image']['type'].'<br/>';
            }
            move_uploaded_file($_FILES['image']['tmp_name'],
                    $_SERVER['DOCUMENT_ROOT'].'/wallpaper/uploads/'.$_FILES['image']['name']);
            var_dump($_FILES['image']['name']);
        }
    else
    {
       echo 'Błąd przy przesyłaniu danych!';
    }


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['name']) && strlen($_POST['name'])>0) {
        $name = $_POST['name'];
        }
        else {
        $name = 'bez nazwy';
        }

    if (isset($_POST['content']) && strlen($_POST['content'])>0) {
    $content = $_POST['content'];
    } else {
    $content = 'brak opisu';
    }
    $category = $_POST['category'];
    $file = $_FILES['image']['name'];
    $original = './uploads/'.$file;
    $small = @imagecreatetruecolor(400, 300);
    $mini = @imagecreatetruecolor(200, 150);
    $fil= imagecreatefromjpeg($original);
    $original_dimensions = getimagesize($original);
    $width = $original_dimensions[0];
    $height = $original_dimensions[1];
    $res = $width . 'x' . $height;
//    $res2= getimagesizefromstring($original);
    imagecopyresampled($small, $fil, 0, 0, 0, 0, 400, 300, $width, $height);
    imagecopyresampled($mini, $fil, 0, 0, 0, 0, 200, 150, $width, $height);
    imagejpeg($small, './uploads/small/'.$file);
    imagejpeg($mini, './uploads/mini/'.$file);
    echo 'Poczekaj chwilę, zapisuje miniaturki...';    
    $pdo = get_connection();

    $query = "INSERT INTO files VALUES(null,'$name','$content',CURRENT_TIMESTAMP, '$category','$file','$res','$width')" ;
    echo '<br>';
    $pdo->query($query);

                
    header('Location: ./wallpap.php');
    die;
    }
?>
