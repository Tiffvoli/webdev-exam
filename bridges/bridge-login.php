<?php

session_start();



if (!isset($_POST['email'])) {
    header('Location: /');
    exit();
}

if (!isset($_POST['password'])) {
    header('Location: /');
    exit();
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    header('Location: /');
    exit();
}
if (
    strlen($_POST['password']) < 2 ||
    strlen($_POST['password']) > 50
) {
    header('Location: /');
    exit();
}


try {
    $db_path = $_SERVER['DOCUMENT_ROOT'] . '/data/users.db';
    $db = new PDO("sqlite:$db_path");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $q = $db->prepare(' SELECT * FROM users WHERE user_email = :email LIMIT 1');
    $q->bindValue(':email', $_POST['email']);
    $q->execute();
    $user = $q->fetch();

    // If user not found
    if (!$user) {
        header('Location: /');
        exit();
    }
    //if user is deactivated
    if ($user['user_stt'] == 0) {
        header('Location: /');
        exit();
    }

    //check hash password
    if (!password_verify($_POST['password'], $user['user_password'])) {
        header('Location: /');
        exit();
    }

    $_SESSION['user_uuid'] = $user['user_uuid'];
    $_SESSION['user_name'] = $user['user_name'];
    $_SESSION['user_lastname'] = $user['user_lastname'];
    $_SESSION['user_age'] = $user['user_age'];
    $_SESSION['user_phone'] = $user['user_phone'];
    $_SESSION['user_email'] = $user['user_email'];
    $_SESSION['user_img'] = $user['user_img'];
    $_SESSION['user_password'] = $user['user_password'];
    header('Location: /user');
    exit();
} catch (PDOException $ex) {
    echo $ex;
}
