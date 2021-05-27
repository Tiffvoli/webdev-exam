<?php

session_start();

if (!isset($_POST['update_password'])) {
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
    $q->bindValue(':admin_password', $_POST['update_password']);
    $q->execute();
    $user = $q->fetch();
    // If user not found
    if (!$user) {
        // echo "user not found";
        header('Location: /admin');
        exit();
    }

    if ($_SESSION['admin_uuid'] = $user['admin_uuid']) {
        // print json_encode($user);
        header('Location: /update');
        exit();
    }
} catch (PDOException $ex) {
    echo $ex;
}
?>
<script>
    let console = <?= json_encode($user) ?>
    console.log(console);
</script>