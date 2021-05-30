<?php


try {
  $db_path = $_SERVER['DOCUMENT_ROOT'] . '/data/users.db';
  $db = new PDO("sqlite:$db_path");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
  $q = $db->prepare('DROP TABLE IF EXISTS users');
  $q->execute();
  $q = $db->prepare('CREATE TABLE users(
    user_uuid         TEXT UNIQUE,
    user_name         TEXT,
    user_lastname     TEXT,
    user_email        TEXT UNIQUE,
    user_age          TEXT,
    user_phone        TEXT,
    user_password     TEXT,
    user_stt          BOOLEAN,
    user_img          TEXT,
    PRIMARY KEY(user_uuid)
  ) WITHOUT ROWID');
  $q->execute();
} catch (PDOException $ex) {
  echo $ex;
}
