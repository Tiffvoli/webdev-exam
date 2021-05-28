<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/components/top-nav.php');
?>

<section id="settings-page">
    <h1 class="title">Reset Password</h1>
    <a href="/" class="text-blue">Back</a>
    <div class="settings-wrapper">

        <form method="POST" action="/change-password" onsubmit="return validate()">
            <label for="email">Email<input name="mail" id="email" type="text"></label>
            <label for="password">Password<input name="reset_password" id="password" type="password"></label>
            <button type="submit" class="btn">Reset Password</button>
        </form>


    </div>

</section>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/components/bottom-footer.php');
?>