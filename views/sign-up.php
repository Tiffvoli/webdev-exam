<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/components/top-nav-index.php');
session_start();
?>
<section id="signup-page" class="flex">
    <div class="herobanner flex-column">
        <h1 class="header">chipper.</h1>
    </div>
    <div id="login-page" class="login flex-column">
        <h1 class="title signup-title">Sign up</h1>

        <form id="form" action="/signup" method="POST" onsubmit="return validate()" enctype="multipart/form-data">

            <div class="omrs-input-group">
                <label class="omrs-input-filled" for="name">
                    <input required name="user_name" id="name" type="text">
                    <span class="omrs-input-label">First name</span>
                </label>
            </div>

            <div class="omrs-input-group">
                <label class="omrs-input-filled" for="lastname">
                    <input required name="user_last_name" id="lastname" type="text">
                    <span class="omrs-input-label">Last name</span>
                </label>
            </div>

            <div class="omrs-input-group">
                <label class="omrs-input-filled" for="email">
                    <input required name="user_email" id="email" type="text" data-validate="email">
                    <span class="omrs-input-label">Email</span>
                </label>
            </div>

            <div class="omrs-input-group">
                <label class="omrs-input-filled" for="age">
                    <input required name="user_age" id="age" type="text" data-validate="int" data-min="15">
                    <span class="omrs-input-label">Age</span>
                </label>
            </div>
            <div class="omrs-input-group">
                <label class="omrs-input-filled" for="phone">
                    <input required name="user_phone" id="phone" type="text" maxlength="8" minlength="8">
                    <span class="omrs-input-label">Phone</span>
                </label>
            </div>

            <div class="omrs-input-group">
                <label class="omrs-input-filled" for="password">
                    <input required name="user_password" id="password" type="password" maxlength="50" data-validate="str" data-min="2" data-max="50">
                    <span class="omrs-input-label">Password</span>
                </label>
            </div>


            <label class="omrs-input-filled" for="image">
                <input required name="user_image" id="image-signin" type="file">
            </label>


            <button type="submit">Sign up</button>
            <div class="btn"><a class="text-blue" href="/">Log in</a></div>
        </form>
    </div>
</section>

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/components/bottom-footer.php');
?>