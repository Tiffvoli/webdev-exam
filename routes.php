<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/router.php');

// ##################################################
// ##################################################
//image
post('/upload-img', '/upload.php');

// Login view
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

//Users settings view
get('/settings', '/views/settings.php');

//Update user info
get('/user/update',  '/views/update.php');

//Update admin password
get('/admin/update',  '/views/update-admin.php');

//Forget password
get('/reset-password',  '/views/reset-password.php');
get('/reset-password/success',  '/views/forget-password-success.php');
get('/forgot-password',  '/views/email-forgot-password.php');

//Email
get('/email-deactivate', 'views/email-deactivate.php');
get('/signup/success', 'views/email-signup.php');
// get('/forgot', 'views/email-forgot-password.php');


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

//Update password
post('/update-password',  '/bridges/bridge-update-password.php');

//Update user info
post('/update-info',  '/bridges/bridge-update-info.php');

//Forget password
post('/change-password',  '/bridges/bridge-change-password.php');
post('/login/change-password/', '/apis/api_reset_password.php');

// Deactivate account
post('/users/deactivate/$user_id', '/apis/api_deactivate_user.php');

// Delete account
post('/delete',  '/views/delete.php');

// Create user database
post('/create-users', '/data/create-users.php'); // Step 1
post('/seed-users', '/data/seed-users.php'); // Step 2

// Create admin database
post('/create-admin', '/data/create-admin.php'); // Step 1
post('/seed-admin', '/data/seed-admin.php'); // Step 2


// The 404.php which is inside the views folder will be called
// The 404.php has access to $_GET and $_POST
any('/404', '/views/404.php');
