<?php

session_start();
$statusMsg = '';
// TODO: Validate all input fields
if (!isset($_POST['user_email'])) {
    header('Location: /signup');
    exit();
}

if (!isset($_POST['user_password'])) {
    header('Location: /signup');
    exit();
}

if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
    header('Location: /signup');
    exit();
}
if (
    strlen($_POST['user_password']) < 2 ||
    strlen($_POST['user_password']) > 50
) {
    header('Location: /signup');
    exit();
}
//upload image file
$valid_extensions = ['png', 'jpg', 'jpeg'];
$image_type = mime_content_type($_FILES['user_image']['tmp_name']); // image/png
$extension = strrchr($image_type, '/'); // /png ... /tmp ... /jpg
$extension = ltrim($extension, '/'); // png ... jpg ... plain

//validate file type 
if (!in_array($extension, $valid_extensions)) {
    echo  $statusMsg = "Please upload the correct file extension.";
    exit();
}
$user_image_name = bin2hex(random_bytes(16)) . ".$extension";
move_uploaded_file($_FILES['user_image']['tmp_name'], "img/$user_image_name");


try {
    $db_path = $_SERVER['DOCUMENT_ROOT'] . '/data/users.db';
    $db = new PDO("sqlite:$db_path");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    // $user_image = $_POST['user_image'];
    // $image =  move_uploaded_file($_FILES['user_image']['tmp_name'], "img/$user_image");
    $q = $db->prepare(' INSERT INTO users 
                        VALUES(:user_uuid, :user_name, :user_last_name,
                        :user_email, :user_age, :user_phone, :user_password, :user_stt, :user_img)');
    $q->bindValue(':user_uuid', bin2hex(random_bytes(16)));
    $q->bindValue(':user_name', $_POST['user_name']);
    $q->bindValue(':user_last_name', $_POST['user_last_name']);
    $q->bindValue(':user_email', $_POST['user_email']);
    $q->bindValue(':user_age', $_POST['user_age']);
    $q->bindValue(':user_phone', $_POST['user_phone']);
    $q->bindValue(':user_password', $_POST['user_password']);
    $q->bindValue(':user_stt', 1);
    $q->bindValue(':user_img', $user_image_name);
    $q->execute();
    if (!$q->rowCount()) {
        header('Location: /signup');
        exit();
    }
    header('Location: /signup/success');
    exit();
} catch (PDOException $ex) {
    echo $ex;
}
