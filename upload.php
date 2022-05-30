<?php
    session_start();
    if(!isset($_SESSION['status'])) {
        header('Location: ./index.php');
        exit();
    }

    require './lib/functions.php';
    
     if (isset($_FILES['my_image'])) {
        $img_name = $_FILES['my_image']['name'];
        $img_size = $_FILES['my_image']['size'];
        $tmp_name = $_FILES['my_image']['tmp_name'];
        $error = $_FILES['my_image']['error'];
        if ($error === 0) {
            if ($img_size > 8125000) {
                $em = "Twój plik jest za duży!";
                header("Location: ./wallpaper.php?error=$em");
            }
            else {
                $img_ext = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ext = strtolower($img_ext);
                $accept_ext = array("png" , "jpg", "jpeg", "bmp"); 
    
                if (in_array($img_ext, $accept_ext)) {
                    $new_img_name = 'IMG-' . $img_name;
                    $img_upload_path = 'uploads/'.$new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);
                    $file = $new_img_name;
                    $small = imagecreatetruecolor(400, 300);
                    $mini = imagecreatetruecolor(200, 150);
                    $fil= imagecreatefromjpeg($img_upload_path);
                    $original_dimensions = getimagesize($img_upload_path);
                    $width = $original_dimensions[0];
                    $height = $original_dimensions[1];
                    $res = $width . 'x' . $height;
                    imagecopyresampled($small, $fil, 0, 0, 0, 0, 400, 300, $width, $height);
                    imagecopyresampled($mini, $fil, 0, 0, 0, 0, 200, 150, $width, $height);
                    imagejpeg($small, './uploads/small/'.$file);
                    imagejpeg($mini, './uploads/mini/'.$file);
                    $pixels = $width*$height;
                    echo 'Poczekaj chwilę, zapisuje miniaturki...';    
                    if (isset($_POST['name']) && strlen($_POST['name'])>0) {
                        $name = clean($_POST['name']);
                        if (strcmp($_POST['name'],$name) != 0) {
                            $name = 'w nazwie były niedozwolone znaki';
                        }     
                    }
                    else $name = 'bez nazwy';
                    if (isset($_POST['content']) && strlen($_POST['content'])>0) {
                        $content = clean($_POST['content']);
                        if (strcmp($_POST['content'],$content) != 0) {
                            $content = 'w opisie były niedozwolone znaki';
                        } 
                    }
                    else $content = 'brak opisu';
                    $category = $_POST['category'];

                    $query = "INSERT INTO files VALUES(null,:nameVal,:contentVal,CURRENT_TIMESTAMP,:categoryVal,:fileVal,:resVal,:pixelsVal)" ;
                    $pdo = get_connection();
                    $stmt = $pdo->prepare($query);
                    if (!$stmt) {
                        $em = "Wystąpił błąd, spróbuj raz jeszcze!";
                        header("Location: ./wallpaper.php?error=$em");
                        exit();
                    }
                    $stmt->bindParam(':nameVal', $name);
                    $stmt->bindParam(':contentVal', $content);
                    $stmt->bindParam(':categoryVal', $category);
                    $stmt->bindParam(':resVal', $res);
                    $stmt->bindParam(':fileVal', $file);
                    $stmt->bindParam(':pixelsVal', $pixels);
                    
                    $stmt->execute();
                
                    header('Location: ./wallpaper.php');
                    exit();
    
                }
                else {
                    $msg = "You can't upload files of this type";
                    header("Location: ./wallpaper.php?error=$msg");
                    exit();
                }
            }
        }
        else {
            $msg = "Nieznany błąd!";
            header("Location: ./wallpaper.php?error=$em");
            exit();
        }
    }
    else header("Location: ./index.php");
?>
