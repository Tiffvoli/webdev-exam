<?php

try {
    require_once "{$_SERVER['DOCUMENT_ROOT']}/faker/autoload.php";
    $faker = Faker\Factory::create();
    $db_path = $_SERVER['DOCUMENT_ROOT'] . '/data/users.db';
    $db = new PDO("sqlite:$db_path");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $q = $db->prepare("INSERT INTO users VALUES (:user_uuid, :user_name, :user_lastname, :user_email, :user_age, :user_phone, :user_password, :user_stt)");
    for ($i = 0; $i < 200; $i++) {
        $q->bindValue(':user_uuid', bin2hex(random_bytes(16)));
        $q->bindValue(':user_name', $faker->firstName());
        $q->bindValue(':user_lastname', $faker->lastName());
        $q->bindValue(':user_email', $faker->email());
        $q->bindValue(':user_age', mt_rand(15, 100));
        $q->bindValue(':user_phone', mt_rand(10000000, 99999999));
        $q->bindValue(':user_password', $faker->password());
        $q->bindValue(':user_stt', true);
        $q->execute();
    }
} catch (PDOException $ex) {
    echo $ex;
}
