<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/components/top-nav-index.php');
session_start();
?>
<section id="signup-page" class="flex">
    <div class="herobanner flex-column">
        <h1 class="header">chipper.</h1>
    </div>
    <div id="login-page" class="login flex-column">
        <h1 class="title signup-title">Forgot Password?</h1>

        <form id="form" action="/check-email" method="POST" onsubmit="return validate()">
            <div class="omrs-input-group">
                <label class="omrs-input-filled" for="email">
                    <input required name="user_email" id="email" type="email" data-validate="email">
                    <span class="omrs-input-label">Email</span>
                </label>
            </div>
            <button type="submit">Reset Password</button>
        </form>
    </div>
</section>

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/components/bottom-footer.php');
?>