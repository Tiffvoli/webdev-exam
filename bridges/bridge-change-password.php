<?php

session_start();


try {
    $db_path = $_SERVER['DOCUMENT_ROOT'] . '/data/users.db';
    $db = new PDO("sqlite:$db_path");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $q = $db->prepare(' UPDATE users 
    SET user_password = :user_password
    WHERE user_email = :user_email ');
    $q->bindParam(':user_password', $_POST['change_password']);
    $q->bindParam(':user_lastname', $_POST['email']);
    // $q->bindValue(':user_name', $_POST['update_name']);
    // $q->bindValue(':user_lastname', $_POST['update_last_name']);
    // $q->bindValue(':user_email', $_POST['update_email']);
    // $q->bindValue(':user_age', $_POST['update_age']);
    // $q->bindValue(':user_phone', $_POST['update_phone']);
    // $q->bindValue(':user_password', $_POST['update_password']);

    $q->execute();
    $user = $q->fetch();

    //valdiate email exist in database
    if ($_POST['email'] == $user['user_email']) {
        header('Location: /forget-password/success');
        exit();
    } else {
        header('Location: /forget-password');
        exit();
    }

    if (!$q->rowCount()) {
        header('Location: /forget-password');
        exit();
    }
    header('Location: /forget-password/success');
    exit();
} catch (PDOException $ex) {
    echo $ex;
}
?>
<script>
    let console = <?= json_encode($user) ?>
    console.log(console);
</script>