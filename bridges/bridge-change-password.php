<?php


try {
    $db_path = $_SERVER['DOCUMENT_ROOT'] . '/data/users.db';
    $db = new PDO("sqlite:$db_path");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $q = $db->prepare(' UPDATE users 
    SET user_password = :user_password
    WHERE user_email = :user_email ');
    $q->bindParam(':user_password', password_hash($_POST['reset_password'], PASSWORD_DEFAULT));
    $q->bindParam(':user_email', $_POST['mail']);

    $q->execute();

    if (!$q->rowCount()) {
        header('Location: /reset-password');
        exit();
    }
    header('Location: /reset-password/success');
    exit();
} catch (PDOException $ex) {
    echo $ex;
}
