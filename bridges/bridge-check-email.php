<?php

session_start();

if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
    header('Location: /');
    exit();
}

try {
    $db_path = $_SERVER['DOCUMENT_ROOT'] . '/data/users.db';
    $db = new PDO("sqlite:$db_path");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $q = $db->prepare(' SELECT * FROM users WHERE user_email = :email LIMIT 1');
    $q->bindValue(':email', $_POST['user_email']);
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

    $_SESSION['user_name'] = $user['user_name'];
    $_SESSION['user_email'] = $user['user_email'];

    header('Location: /forgot-password');
    exit();
} catch (PDOException $ex) {
    echo $ex;
}
