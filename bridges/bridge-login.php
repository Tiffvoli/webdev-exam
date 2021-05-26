<?php

session_start();

if (!isset($_POST['email'])) {
    header('Location: /login');
    exit();
}

if (!isset($_POST['password'])) {
    header('Location: /login');
    exit();
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    header('Location: /login');
    exit();
}
if (
    strlen($_POST['password']) < 2 ||
    strlen($_POST['password']) > 50
) {
    header('Location: /login');
    exit();
}


try {
    $db_path = $_SERVER['DOCUMENT_ROOT'] . '/data/users.db';
    $db = new PDO("sqlite:$db_path");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $q = $db->prepare(' SELECT * FROM users WHERE user_email = :email;');
    $q->bindValue(':email', $_POST['email']);
    $q->execute();
    $user = $q->fetch();
    // If user not found
    if (!$user) {
        // echo "user not found";
        header('Location: /login');
        exit();
    }

    if ($_SESSION['user_uuid'] = $user['user_uuid']) {
        // print json_encode($user);
        header('Location: /user');
        exit();
    }
} catch (PDOException $ex) {
    echo $ex;
}
?>
<script>
    let console = <?= json_encode($user) ?>
    console.log(console);
</script>