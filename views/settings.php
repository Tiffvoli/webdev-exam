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
    <a href="/user">Back</a>
    <div class="settings-wrapper">
        <div>
            <form method="POST" action="/update-info" onsubmit="return validate()">
                <fieldset class="flex fieldset">
                    <label for="name">First name<input name="update_name" id="name" type="text" value="<?= $user['user_lastname'] ?>"></label>
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