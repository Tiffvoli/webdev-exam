<?php


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
            $local_path = $_SERVER['DOCUMENT_ROOT'] . '/img/placeholder.png';
            $db = new PDO("sqlite:$db_path");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $q = $db->prepare('SELECT * FROM users ORDER BY user_name;');
            $q->execute();
            $users = $q->fetchAll();
            foreach ($users as $user) {
                unset($user['user_password']);
        ?>

                <div class="user flex-column">
                    <h3 class="text-white"><?= $user['user_name'] ?> <?= $user['user_lastname'] ?></h3>
                    <img class="placeholder" src="/../img/<?= basename($user['user_img']) ?>">
                    <p><b>ID:</b> <?= $user['user_uuid'] ?></p>
                    <p><b>Age:</b> <?= $user['user_age'] ?></p>
                    <p><b>Email:</b> <?= $user['user_email'] ?></p>
                    <p><b>Phone:</b> <?= $user['user_phone'] ?></p>
                    <?php if (!$user['user_stt'] == 1) {
                        echo '<div class="btn btn-disable">Blocked</div>';
                    }
                    ?>
                    <button id="deactivate-btn" class="btn btn-yellow-outline <?php if (!$user['user_stt'] == 1) {
                                                                                    echo ' hide';
                                                                                } ?>" onclick="deactivate_user('<?= $user['user_uuid'] ?>')">
                        Deactivate account
                    </button>

                </div>

        <?php
            }
        } catch (PDOException $ex) {
            echo $ex;
        } ?>
    </div>
</section>
<script>
    async function deactivate_user(user_id) {
        let div_user = event.target.parentNode
        let conn = await fetch(`/users/deactivate/${user_id}`, {
            "method": "POST"
        })
        if (!conn.ok) {
            alert("upps...");
            return
        }
        let data = await conn.text()
        console.log(data)
        div_user.remove();
    }
</script>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/components/bottom-footer.php');
?>