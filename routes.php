<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/router.php');

// ##################################################
// ##################################################

// Get pages or views
get('/home', '/index.php');

// Login view
get('/', '/views/log-in.php');

// Logout view
get('/logout', '/views/log-out.php');

// Admin view
get('/admin', '/views/admin.php');

//User view
get('/user', '/views/user.php');

// Sign-up view
get('/signup',  '/views/sign-up.php');

// Users view
get('/users', '/views/users.php');


// ##################################################
// ##################################################

// Sending data for login
post('/login',  '/bridges/bridge-login.php');

// sending though admin

post('/admin', '/bridges/bridge-loginadmin.php');

// Log out
post('/logout',  '/bridges/bridge-logout.php');

// Sending data for sign up
post('/signup',  '/bridges/bridge-signup.php');

// Deactivate account
post('/deactivate',  '/views/deactivate.php');

// Create fake database
post('/create-users', '/data/create-users.php'); // Step 1
post('/seed-users', '/data/seed-users.php'); // Step 2


// The 404.php which is inside the views folder will be called
// The 404.php has access to $_GET and $_POST
any('/404', '/views/404.php');
