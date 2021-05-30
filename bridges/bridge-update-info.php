<?php

session_start();


$statusMsg = 'Hi';

if (!isset($_SESSION['user_uuid'])) {
    header('Location: /settings');
    exit();
}
//upload image file
$valid_extensions = ['png', 'jpg', 'jpeg'];
$image_file = $_FILES['update_image']['tmp_name'];

//if file is uploaded and not empty
if (!empty($image_file)) {
    $image_type = mime_content_type($_FILES['update_image']['tmp_name']); // image/png
    $extension = strrchr($image_type, '/'); // /png ... /tmp ... /jpg
    $extension = ltrim($extension, '/'); // png ... jpg ... plain
    $user_image_name = bin2hex(random_bytes(16)) . ".$extension";
    move_uploaded_file($_FILES['update_image']['tmp_name'], "img/$user_image_name");
    //validate file extension
    if (!in_array($extension, $valid_extensions)) {
        echo  $statusMsg = "Please upload the correct file extension.";
        exit();
    }
}

try {
    $db_path = $_SERVER['DOCUMENT_ROOT'] . '/data/users.db';
    $db = new PDO("sqlite:$db_path");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $q = $db->prepare(' UPDATE users 
    SET user_name = :user_name,
        user_lastname = :user_lastname,
        user_email = :user_email,
        user_age = :user_age,
        user_phone = :user_phone,
        user_password = :user_password,
        user_img = :user_img
    WHERE user_uuid = :user_uuid ');
    $q->bindParam(':user_name', $_POST['update_name']);
    $q->bindParam(':user_lastname', $_POST['update_last_name']);
    $q->bindParam(':user_email', $_POST['update_email']);
    $q->bindParam(':user_age', $_POST['update_age']);
    $q->bindParam(':user_phone', $_POST['update_phone']);
    //if password hasn't changed
    if ($_SESSION['user_password'] == $_POST['update_password']) {
        $q->bindParam(':user_password', $_POST['update_password']);
    } else { //if password has changed and need to rehash
        $q->bindParam(':user_password',  password_hash($_POST['update_password'], PASSWORD_DEFAULT));
    }
    $q->bindParam(':user_uuid', $_SESSION['user_uuid']);
    //if there is no file uploaded
    if (empty($image_file)) {
        $q->bindParam(':user_img',  $_SESSION['user_img']);
    } else {   //if there is file uploaded, sometimes need to re sign in to load
        $q->bindParam(':user_img', $user_image_name);
    }
    $q->execute();
    if (!$q->rowCount()) {
        header('Location: /settings');
        exit();
    }
    header('Location: /user/update');
    exit();
} catch (PDOException $ex) {
    echo $ex;
}
