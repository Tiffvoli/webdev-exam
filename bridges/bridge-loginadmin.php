<?php

session_start();

// admin validation
if (!isset($_POST['email_admin'])) {
    header('Location: /');
    exit();
}

if (!isset($_POST['password_admin'])) {
    header('Location: /');
    exit();
}

if (!filter_var($_POST['email_admin'], FILTER_VALIDATE_EMAIL)) {
    header('Location: /');
    exit();
}
if (
    strlen($_POST['password_admin']) < 2 ||
    strlen($_POST['password_admin']) > 50
) {
    header('Location: /');
    exit();
}

try {
    header('Location: /admin');
    exit();
} catch (PDOException $ex) {
    echo $ex;
}
