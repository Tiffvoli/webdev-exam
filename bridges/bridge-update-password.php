<?php

session_start();

if (!isset($_SESSION['admin_uuid'])) {
    header('Location: /admin');
    exit();
}


try {
    $db_path = $_SERVER['DOCUMENT_ROOT'] . '/data/admin.db';
    $db = new PDO("sqlite:$db_path");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $q = $db->prepare(' UPDATE admin 
    SET admin_password = :admin_password
    WHERE admin_uuid = :admin_uuid ');
    $q->bindParam(':admin_password', $_POST['update_password']);
    $q->bindParam(':admin_uuid', $_SESSION['admin_uuid']);

    $q->execute();

    if (!$q->rowCount()) {
        header('Location: /admin');
        exit();
    }
    header('Location: /admin/update');
    exit();
} catch (PDOException $ex) {
    echo $ex;
}
?>
<script>
    let console = <?= json_encode($user) ?>
    console.log(console);
</script>