<?php
session_start();


if (!isset($_SESSION['admin_uuid'])) {
    header('Location: /');
    exit();
}

try {
    $db_path = $_SERVER['DOCUMENT_ROOT'] . '/data/admin.db';
    $db = new PDO("sqlite:$db_path");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $q = $db->prepare('SELECT * FROM admin WHERE admin_uuid = :admin_uuid');
    $q->bindValue(':admin_uuid', $_SESSION['admin_uuid']);
    $q->execute();
    $user = $q->fetch();
    if (!$user) {
        header('Location: /');
        exit();
    }
} catch (PDOException $ex) {
    echo $ex;
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/components/top-nav-admin.php'); ?>


<section id="admin-page" class="flex">

    <div class="center-text">
        <h1 class="admin-title">Welcome
            <span> <?= $user['admin_name'] ?>&nbsp<?= $user['admin_lastname'] ?></span>
        </h1>
        <img src="/../img/avatar.jpg" class="placeholder-admin">
        <div class="btn btn-yellow"><a class="text-blue" href="/users">View all users</a></div>
        <button onclick="update_password()" class="btn btn-yellow">Update Password</button>
        <form method="POST" action="/update-password" class="hide text-left" id="update_password">
            <label for="password">New password<input name="update_password" id="password" type="password" maxlength="50" data-validate="str" data-min="2" data-max="50"></label>
            <button type="submit" class="btn">Update Password</button>
        </form>
        <div class="btn btn-blue"><a href="/logout">Log out</a></div>
        <script>
            const update_pass = document.querySelector("#update_password");

            function update_password() {
                update_pass.classList.toggle("hide");
                console.log("clicked");
            }
        </script>
    </div>

</section>

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/components/bottom-footer.php');
?>