<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['user_uuid'])) {
    header('Location: /');
    exit();
}

try {
    $db_path = $_SERVER['DOCUMENT_ROOT'] . '/data/users.db';
    $db = new PDO("sqlite:$db_path");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $q = $db->prepare('SELECT * FROM users WHERE user_uuid = :user_uuid');
    $q->bindValue(':user_uuid', $_SESSION['user_uuid']);
    $q->execute();
    $user = $q->fetch();
    if (!$user) {
        header('Location: /');
        exit();
    }
} catch (PDOException $ex) {
    echo $ex;
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/components/top-nav.php'); ?>


<section id="user-page" class="flex">

    <div class="feed">
        <div class="profile center-text">
            <h1 class="title">Welcome back, <?= $user['user_name'] ?>!</h1>
            <div class="profile-wrapper">
                <div>
                    <img class="placeholder" src="/../img/placeholder.png">
                    <h3 class="text-white"><?= $user['user_name'] ?> <?= $user['user_lastname'] ?></h3>
                    <p> <?= $user['user_email'] ?></p>
                    <p class="text-bold">Age <span> <?= $user['user_age'] ?></span></p>
                    <p class="text-bold"> Phone <span> <?= $user['user_phone'] ?></span></p>
                </div>
                <div>
                    <div class="btn btn-yellow"><a href="/settings" class="text-blue">Settings</a></div>
                    <div class="btn btn-white-outline"><a href="/logout">Log out</a></div>
                    <form method="POST" action="/delete">
                        <button type="submit" class="btn btn-yellow-outline">Delete account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/components/bottom-footer.php');
?>