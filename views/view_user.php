<?php

// VALITE EVERYTHING YOU CAN COME UP WITH
// 0054592281c8da68494d7101391445c6

if( ! isset($user_uuid) ){
  header('Location: /search');
  exit();
}
if( strlen($user_uuid) != 32){
  header('Location: /search');
  exit();
}
if( ! ctype_alnum($user_uuid) ) // '/[^a-z\d]/i' should also work.
{
  header('Location: /search');
  exit();
}

try{
  $db_path = $_SERVER['DOCUMENT_ROOT'].'/db/users.db';
  $db = new PDO("sqlite:$db_path");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  // full text search
  $q = $db->prepare(' SELECT user_name, user_last_name, user_phone, user_email
                      FROM users 
                      WHERE user_uuid = :user_uuid 
                      LIMIT 1');
  $q->bindValue(':user_uuid', $user_uuid);
  $q->execute();
  $user = $q->fetch();
  ?>
  <div>
    <div><?= $user['user_name'] ?></div>
    <div><?= $user['user_last_name'] ?></div>
    <div><?= $user['user_phone'] ?></div>
    <div><?= $user['user_email'] ?></div>
  </div>
  <?php
}catch(PDOException $ex){
  echo $ex;
}






