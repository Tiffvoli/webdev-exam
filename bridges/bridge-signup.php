<?php

session_start();

// TODO: Validate all input fields
if (!isset($_POST['email'])) {
    header('Location: /signup');
    exit();
}

if (!isset($_POST['password'])) {
    header('Location: /signup');
    exit();
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    header('Location: /signup');
    exit();
}
if (
    strlen($_POST['password']) < 2 ||
    strlen($_POST['password']) > 50
) {
    header('Location: /signup');
    exit();
}

try {
    $db_path = $_SERVER['DOCUMENT_ROOT'] . '/data/users.db';
    $db = new PDO("sqlite:$db_path");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $q = $db->prepare(' INSERT INTO users 
                        VALUES(:user_uuid, :user_name, :user_last_name,
                        :user_email, :user_phone, :user_password, :user_active)');
    $q->bindValue(':user_uuid', bin2hex(random_bytes(16))); // 32 alphanumeric
    $q->bindValue(':user_name', $_POST['user_name']);
    $q->bindValue(':user_last_name', $_POST['user_last_name']);
    $q->bindValue(':user_email', $_POST['user_email']);
    $q->bindValue(':user_phone', $_POST['user_phone']);
    $q->bindValue(':user_password', password_hash($_POST['user_password'], PASSWORD_DEFAULT));
    $q->bindValue(':user_active', 1);
    $q->execute();
    if (!$q->rowCount()) {
        header('Location: /signup');
        exit();
    }
    header('Location: /login');
    exit();
} catch (PDOException $ex) {
    echo $ex;
}
