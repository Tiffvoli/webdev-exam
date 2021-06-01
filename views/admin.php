<?php
session_start();

if (!isset($_SESSION['admin_uuid'])) {
    header('Location: /');
    exit();
}

try {
    $db_path = $_SERVER['DOCUMENT_ROOT'] . '/data/admin.db';
    $db = new PDO("sqlite:$db_path");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $q = $db->prepare('SELECT * FROM admin WHERE admin_uuid = :admin_uuid');
    $q->bindValue(':admin_uuid', $_SESSION['admin_uuid']);
    $q->execute();
    $user = $q->fetch();
    if (!$user) {
        header('Location: /');
        exit();
    }
} catch (PDOException $ex) {
    echo $ex;
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/components/top-nav-admin.php'); ?>


<section id="admin-page" class="flex">
    <div class="flex-column admin-wrapper">
        <h1 class="admin-title">Welcome
            <span> <?= $user['admin_name'] ?>&nbsp<?= $user['admin_lastname'] ?></span>
        </h1>
        <div class="admin flex-column">
            <img src="/../img/avatar.jpg" class="placeholder-admin">
            <h3 style="padding-bottom: 0.5rem">Admin</h3>
            <div class="btn btn-yellow"><a class="text-blue" href="/users">View all users</a></div>
            <button onclick="update_password()" class="btn btn-yellow text-normal">Update Password</button>
            <form method="POST" action="/update-password" class="hide text-left" id="update_password" onsubmit="return validate()">
                <label for="password">New password<input name="update_password" id="password" type="password" maxlength="50" data-validate="str" data-min="2" data-max="50"></label>
                <button type="submit" class="btn">Update Password</button>
            </form>
            <div class="btn btn-blue"><a href="/logout">Log out</a></div>
            <script>
                const update_pass = document.querySelector("#update_password");

                function update_password() {
                    update_pass.classList.toggle("hide");
                    console.log("clicked");
                }
            </script>
        </div>
    </div>
    <div class="feed">
        <!-- feed posts -->
        <h4>Community activities</h4>

        <div class="tweet flex">
            <img class="placeholder placeholder-tweet" src="/img/stock-profile-2.jpg">
            <div class="tweet-text">
                <h1>Christina Hansen</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <p class="date-time">01/06/21 &nbsp <span>02.41</span> &nbsp <span>Likes</span> &nbsp <span class="text-red">Guidelines violated &nbsp<a href="/users" class="text-red">Block</a></span></p>
            </div>
        </div>
        <div class="tweet flex">
            <img class="placeholder placeholder-tweet" src="/img/stock-profile-4.jpg">
            <div class="tweet-text">
                <h1>Emily Andersen</h1>
                <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <p class="date-time">31/05/21 &nbsp <span>17.23</span> &nbsp <span>Likes</span></p>
            </div>
        </div>
        <div class="tweet flex">
            <img class="placeholder placeholder-tweet" src="/img/stock-profile-1.jpg">
            <div class="tweet-text">
                <h1>Tobias Larsen</h1>
                <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <p class="date-time">25/05/21 &nbsp <span>09.38</span> &nbsp <span>Likes</span>&nbsp <span class="text-red">Guidelines violated &nbsp<a href="/users" class="text-red">Block</a></span></p>
            </div>
        </div>
        <div class="tweet flex">
            <img class="placeholder placeholder-tweet" src="/img/stock-profile-5.jpg">
            <div class="tweet-text">
                <h1>Sille Nygaard</h1>
                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                <p class="date-time">25/05/21 &nbsp <span>12.10</span> &nbsp <span>Likes</span></p>
            </div>
        </div>
        <div class="tweet flex">
            <img class="placeholder placeholder-tweet" src="/img/stock-profile-3.jpg">
            <div class="tweet-text">
                <h1>Lasse Rasmussen</h1>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium</p>
                <p class="date-time">24/05/21 &nbsp <span>19.31</span> &nbsp <span>Likes</span></p>
            </div>
        </div>
    </div>
</section>

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/components/bottom-footer.php');
?>