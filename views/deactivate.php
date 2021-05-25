<?php
session_start();

if (!isset($_SESSION['user_uuid'])) {
    header('Location: /login');
    exit();
}


try {
    $db_path = $_SERVER['DOCUMENT_ROOT'] . '/data/users.db';
    $db = new PDO("sqlite:$db_path");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $q = $db->prepare(' UPDATE users 
                      SET user_stt = :user_stt
                      WHERE user_uuid = :user_uuid ');
    $q->bindValue(':user_stt', 0);
    $q->bindValue(':user_uuid', $_SESSION['user_uuid']);
    $q->execute();

    if (!$q->rowCount()) {
        header('Location: /admin');
        exit();
    }

    session_destroy();
} catch (PDOException $ex) {
    echo $ex;
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/components/top-nav.php');
?>
<section id="deactivate-page">
    <h1 class="title">Deactivation</h1>
    <br />
    <p>Your account is now deactivated.</p>
    <a href="/" class="btn">Back to home</a>
</section>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/components/bottom-footer.php'); ?>