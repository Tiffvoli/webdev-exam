<?php

session_start();

if (!isset($_SESSION['user_uuid'])) {
    header('Location: /');
    exit();
}

try {
    $db_path = $_SERVER['DOCUMENT_ROOT'] . '/data/users.db';
    $db = new PDO("sqlite:$db_path");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $q = $db->prepare('SELECT * FROM users WHERE user_uuid = :user_uuid');
    $q->bindValue(':user_uuid', $_SESSION['user_uuid']);
    $q->execute();
    $user = $q->fetch();
    if (!$user) {
        header('Location: /');
        exit();
    }
} catch (PDOException $ex) {
    echo $ex;
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/components/top-nav.php'); ?>


<section id="user-page" class="flex">
    <div class="feed-user">
        <div class="profile">
            <!-- user profile -->
            <div class="profile-wrapper">
                <div>
                    <img class="placeholder" src="/img/<?= basename($user['user_img']) ?>">
                    <h3 class="text-white"><?= $user['user_name'] ?> <?= $user['user_lastname'] ?></h3>
                    <p> <?= $user['user_email'] ?></p>
                </div>
                <div class="user-tweet">
                    <div>
                        <h5 class="text-blue">POSTS</h5>
                        <h3 class="text-blue">70</h3>
                    </div>
                    <div>
                        <h5 class="text-blue">FOLLOWERS</h5>
                        <h3 class="text-blue">282</h3>
                    </div>
                    <div>
                        <h5 class="text-blue">FOLLOWING</h5>
                        <h3 class="text-blue">123</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="cta-buttons">
            <!-- CTA Buttons -->
            <div class="btn btn-yellow"><a href="/settings" class="text-blue">Settings</a></div>
            <div class="btn"><a href="/logout" class="text-blue">Log out</a></div>
            <form method="POST" action="/delete">
                <button type="submit" class="btn btn-blue text-white">Delete account</button>
            </form>
        </div>
    </div>
    <div class="feed">
        <!-- feed posts -->
        <h4>Feed</h4>
        <div class="tweet tweet-post flex">
            <img class="placeholder placeholder-tweet" src="/img/<?= basename($user['user_img']) ?>">
            <p>Post something...</p>
        </div>
        <div class="tweet flex">
            <img class="placeholder placeholder-tweet" src="/img/stock-profile-2.jpg">
            <div class="tweet-text">
                <h1>Christina Hansen</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <p class="date-time">01/06/21 &nbsp <span>02.41</span> &nbsp <span>Likes</span></p>
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
                <p class="date-time">25/05/21 &nbsp <span>09.38</span> &nbsp <span>Likes</span></p>
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