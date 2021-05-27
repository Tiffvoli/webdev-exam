<?php

try {
    require_once "{$_SERVER['DOCUMENT_ROOT']}/faker/autoload.php";
    $faker = Faker\Factory::create();
    $db_path = $_SERVER['DOCUMENT_ROOT'] . '/data/admin.db';
    $db = new PDO("sqlite:$db_path");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $q = $db->prepare("INSERT INTO admin VALUES (:admin_uuid, :admin_name, :admin_lastname, :admin_email, :admin_password, :is_admin)");
    for ($i = 0; $i < 1; $i++) {
        $q->bindValue(':admin_uuid', bin2hex(random_bytes(16)));
        $q->bindValue(':admin_name', 'Tiffany');
        $q->bindValue(':admin_lastname', 'Tran');
        $q->bindValue(':admin_email', 'tiffany@gmail.com');
        $q->bindValue(':admin_password', 'tiff');
        $q->bindValue(':is_admin', true);
        $q->execute();
    }
} catch (PDOException $ex) {
    echo $ex;
}
