<?php

try {
    $db_path = $_SERVER['DOCUMENT_ROOT'] . '/data/users.db';
    $db = new PDO("sqlite:$db_path");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $q = $db->prepare(' UPDATE users 
    SET user_stt = 0
    WHERE user_uuid = :user_uuid ');
    $q->bindValue(':user_uuid', $user_id);
    $q->execute();
    if (!$q->rowCount()) {
        echo "error";
    } else {
        echo "success";
        header('Location: /email-deactivate');
        exit();
    }
} catch (PDOException $ex) {
    echo $ex;
}
