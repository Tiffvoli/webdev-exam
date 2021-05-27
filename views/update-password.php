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
    if ($_POST['update_password'] != NULL) {
        $q->bindValue(':admin_password', $_POST['update_password']);
    }
    $q->execute();
} catch (PDOException $ex) {
    echo $ex;
}
require_once($_SERVER['DOCUMENT_ROOT'] . '/components/top-nav.php');
?>
<section id="deactivate-page">
    <h1 class="title">Password Updated</h1>
    <br />
    <p>Your password is now updated</p>
    <a href="/admin" class="btn">Back to home</a>
</section>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/components/bottom-footer.php'); ?>