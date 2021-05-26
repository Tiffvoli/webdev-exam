<?php
session_start();
// if (!isset($_SESSION)) {
//     session_start();
// }

// if (!isset($_SESSION['user_uuid'])) {
//     header('Location: /login');
//     exit();
// }

// try {
//     $db_path = $_SERVER['DOCUMENT_ROOT'] . '/data/users.db';
//     $db = new PDO("sqlite:$db_path");
//     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
//     $q = $db->prepare('SELECT * FROM users WHERE user_uuid = :user_uuid');
//     $q->bindValue(':user_uuid', $_SESSION['user_uuid']);
//     $q->execute();
//     $user = $q->fetch();
//     if (!$user) {
//         header('Location: /login');
//         exit();
//     }
// } catch (PDOException $ex) {
//     echo $ex;
// }

require_once($_SERVER['DOCUMENT_ROOT'] . '/components/top-nav-admin.php'); ?>


<section id="admin-page" class="flex">

    <div class="center-text">
        <h1>Welcome
            <span class="admin_name"></span>
        </h1>
    </div>

</section>

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/components/bottom-footer.php');
?>