<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/components/top-nav.php');
?>
<section id="signup-page">
    <h1 class="title signup-title">Sign up</h1>

    <form id="form" action="/signup" method="POST" onsubmit="">
        <fieldset id="name-group">
            <label for="name">First name<input name="name" id="name" type="text" placeholder="Enter your first name"></label>
            <label for="lastname">Last name<input name="lastname" id="lastname" type="text" placeholder="Enter your last name"></label>
        </fieldset>
        <label for="email">Email<input name="email" id="email" type="text" placeholder="Enter your preferred email"></label>
        <label for="password">Password<input name="password" id="password" type="password" placeholder="Enter your preferred password"></label>
        <label for="confirm-pass">Repeat your password<input name="confirm-pass" id="confirm-pass" type="password" placeholder="Re-enter your password"></label>
        <button type="submit">Sign up</button>
    </form>

</section>

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/components/bottom-footer.php');
?>