<?php

session_start();

//validate fields 
if (!isset($_POST['email_admin'])) {
    header('Location: /');
    exit();
}

if (!isset($_POST['password_admin'])) {
    header('Location: /');
    exit();
}

if (!filter_var($_POST['email_admin'], FILTER_VALIDATE_EMAIL)) {
    header('Location: /');
    exit();
}
if (
    strlen($_POST['password_admin']) < 2 ||
    strlen($_POST['password_admin']) > 50
) {
    header('Location: /');
    exit();
}


try {
    $db_path = $_SERVER['DOCUMENT_ROOT'] . '/data/admin.db';
    $db = new PDO("sqlite:$db_path");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $q = $db->prepare(' SELECT * FROM admin WHERE admin_email = :_email;');
    $q->bindValue(':_email', $_POST['email_admin']);
    $q->execute();
    $user = $q->fetch();
    // If user not found
    if (!$user) {
        // echo "user not found";
        header('Location: /');
        exit();
    }

    $_SESSION['admin_uuid'] = $user['admin_uuid'];

    header('Location: /admin');
} catch (PDOException $ex) {
    echo $ex;
}
?>
<script>
    let console = <?= json_encode($user) ?>
    console.log(console);
</script>