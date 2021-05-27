<?php

session_start();
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['admin_uuid'])) {
    header('Location: /');
    exit();
}
require_once($_SERVER['DOCUMENT_ROOT'] . '/components/top-nav-admin.php');
?>
<!-- Main part of the page -->
<section id="users-page">
    <h1 class="title users-title">List of users</h1>
    <div id="users">
        <?php
        try {
            $db_path = $_SERVER['DOCUMENT_ROOT'] . '/data/users.db';
            $db = new PDO("sqlite:$db_path");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $q = $db->prepare('SELECT * FROM users ORDER BY user_age;');
            $q->execute();
            $users = $q->fetchAll();
            foreach ($users as $user) {
                unset($user['user_password']);
        ?>

                <div class="user flex-column">
                    <!-- <p>ID: </p> -->
                    <h3 class="text-white"><?= $user['user_name'] ?> <?= $user['user_lastname'] ?></h3>
                    <img class="placeholder" src="/../img/placeholder.png">
                    <p><b>Age:</b> <?= $user['user_age'] ?></p>
                    <p><b>Email:</b> <?= $user['user_email'] ?></p>
                    <p><b>Phone:</b> <?= $user['user_phone'] ?></p>
                    <form method="POST" action="/deactivate">
                        <button type="submit" class="btn btn-yellow-outline">Deactivate account</button>
                    </form>
                </div>

        <?php
            }
        } catch (PDOException $ex) {
            echo $ex;
        } ?>
    </div>
</section>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/components/bottom-footer.php');
?>