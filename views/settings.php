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
            <label for="name">First name<input name="user_name" id="name" type="text" placeholder="Enter your first name"></label>
            <label for="lastname">Last name<input name="user_last_name" id="lastname" type="text" placeholder="Enter your last name"></label>
            <label for="user_email">Email<input name="user_email" id="email" type="text" placeholder="Enter your preferred email"></label>
            <label for="user_age">Age<input name="user_age" id="age" type="text" placeholder="Enter your age"></label>
            <label for="user_phone">Phone<input name="user_phone" id="age" type="text" placeholder="Enter your phone"></label>
            <label for="user_password">Password<input name="user_password" id="password" type="password" placeholder="Enter your preferred password"></label>

        </div>
    </div>
    </div>

</section>





<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/components/bottom-footer.php');
?>