<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/components/top-nav.php');

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
?>



<section id="settings-page">
    <h1 class="title">Profile Settings</h1>
    <a href="/">
        <svg class="btn-back" id="ba70501b-68e7-48bf-95ab-e0c74e8b3e16" xmlns="http://www.w3.org/2000/svg" width="53.5" height="53.5" viewBox="0 0 53.5 53.5">
            <path id="Path_26" data-name="Path 26" d="M26.75,53.5A26.75,26.75,0,1,1,53.5,26.75,26.78,26.78,0,0,1,26.75,53.5Zm0-52.311A25.561,25.561,0,1,0,52.311,26.75,25.59,25.59,0,0,0,26.75,1.189Z" fill="#00539c" />
            <path id="Path_27" data-name="Path 27" d="M144.282,151.615a.592.592,0,0,1-.418-.175l-7.136-7.133a.6.6,0,0,1,0-.836l7.134-7.134a.595.595,0,1,1,.836.836l-6.713,6.713L144.7,150.6a.595.595,0,0,1-.418,1.015Z" transform="translate(-122.288 -121.893)" fill="#00539c" />
            <path id="Path_28" data-name="Path 28" d="M152.58,222.634h-3.566a.595.595,0,0,1,0-1.189h3.566a7.732,7.732,0,1,0,0-15.455H137.125a.595.595,0,0,1,0-1.189H152.58a8.917,8.917,0,0,1,0,17.834Z" transform="translate(-122.264 -183.4)" fill="#00539c" />
        </svg>
    </a>
    <div class="settings-wrapper">
        <div>
            <form method="POST" action="/update-info" onsubmit="return validate()">
                <fieldset class="flex fieldset">
                    <label for="name">First name<input name="update_name" id="name" type="text" value="<?= $user['user_name'] ?>"></label>
                    <label for="lastname">Last name<input name="update_last_name" id="lastname" type="text" value="<?= $user['user_lastname'] ?>"></label>
                </fieldset>
                <fieldset class="flex fieldset">
                    <label for="user_age">Age<input name="update_age" id="age" type="text" value="<?= $user['user_age'] ?>"></label>
                    <label for="user_phone">Phone<input name="update_phone" id="age" type="text" value="<?= $user['user_phone'] ?>"></label>
                </fieldset>
                <label for=" user_email">Email<input name="update_email" id="email" type="text" value="<?= $user['user_email'] ?>"></label>
                <label for="user_password">Password<input name="update_password" id="password" type="password" value="<?= $user['user_password'] ?>"></label>

                <button type="submit" class="btn btn-yellow">Update Information</button>
            </form>
        </div>
    </div>
    </div>

</section>





<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/components/bottom-footer.php');
?>