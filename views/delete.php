<?php
session_start();

if (!isset($_SESSION['user_uuid'])) {
    header('Location: /user');
    exit();
}

try {
    $db_path = $_SERVER['DOCUMENT_ROOT'] . '/data/users.db';
    $db = new PDO("sqlite:$db_path");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $q = $db->prepare('DELETE FROM users WHERE user_uuid = :user_uuid');
    $q->bindValue(':user_uuid', $_SESSION['user_uuid']);
    $q->execute();
} catch (PDOException $ex) {
    echo $ex;
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/components/top-nav.php');
?>
<section id="deactivate-page" class="center-text">
    <h1 class="title">Account deleted</h1>
    <br />
    <p>Your account is now deleted.</p>
    <a href="/" class="btn">Back to home</a>
</section>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/components/bottom-footer.php'); ?>