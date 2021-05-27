<?php
session_start();

if (!isset($_SESSION['admin_uuid'])) {
    header('Location: /admin');
    exit();
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/components/top-nav.php');
?>

<section id="deactivate-page">
    <h1 class="title">Personal Information Update</h1>
    <br />
    <p>Your details have been updated</p>
    <a href="/" class="btn">Back to home</a>
</section>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/components/bottom-footer.php'); ?>