<?php


try {
    $db_path = $_SERVER['DOCUMENT_ROOT'] . '/data/admin.db';
    $db = new PDO("sqlite:$db_path");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $q = $db->prepare('DROP TABLE IF EXISTS admin');
    $q->execute();
    $q = $db->prepare('CREATE TABLE admin(
    admin_uuid         TEXT UNIQUE,
    admin_name         TEXT,
    admin_lastname     TEXT,
    admin_email        TEXT UNIQUE,
    admin_password     TEXT,
    is_admin          BOOLEAN,
    PRIMARY KEY(admin_uuid)
  ) WITHOUT ROWID');
    $q->execute();
} catch (PDOException $ex) {
    echo $ex;
}
