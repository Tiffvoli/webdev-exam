<?php

try {
    $db_path = $_SERVER['DOCUMENT_ROOT'] . '/data/users.db';
    $db = new PDO("sqlite:$db_path");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $q = $db->prepare(' UPDATE users 
    SET user_pass = :user_pass
    WHERE user_mail = :user_mail ');
    $q->bindValue(':user_pass',  $_POST['reset_password']);
    $q->bindValue(':user_mail', $_POST['email']);
    $q->execute();
    if (!$q->rowCount()) {
        echo "error";
    } else {
        echo "success";
    }
} catch (PDOException $ex) {
    echo $ex;
}
