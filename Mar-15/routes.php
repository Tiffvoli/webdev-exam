<?php

require_once(__DIR__.'/router.php');

// ##################################################
get('/', 'serve_index');
function serve_index(){
  $page_title = 'Welcome';
  require_once(__DIR__.'/views/view_top.php');
  require_once(__DIR__.'/views/view_index.php');
  require_once(__DIR__.'/views/view_bottom.php');
  exit();
}

// ##################################################
get('/admin', 'serve_admin');
function serve_admin(){
  session_start();
  if( ! isset( $_SESSION['email'] ) ){
    header('Location: /login');
    exit();
  }
  require_once(__DIR__.'/views/view_admin.php');
  exit();
}

// ##################################################
get('/login', 'serve_login');
function serve_login(){
  $page_title = 'login';
  require_once(__DIR__.'/views/view_top.php');
  require_once(__DIR__.'/views/view_login.php');
  require_once(__DIR__.'/views/view_bottom.php');
  exit();
}

// ##################################################
get('/login/error', 'serve_login_error');
function serve_login_error(){
  $page_title = 'login';
  require_once(__DIR__.'/views/view_top.php');
  $display_error = true;
  require_once(__DIR__.'/views/view_login.php');
  require_once(__DIR__.'/views/view_bottom.php');
  exit();
}

// ##################################################
get('/logout', 'serve_logout');
function serve_logout(){
  require_once(__DIR__.'/bridges/bridge_logout.php');
  exit();
}

// ##################################################
get('/users', 'serve_users');
function serve_users(){
  $page_title = 'Users';
  require_once(__DIR__.'/views/view_top.php');
  require_once(__DIR__.'/views/view_users.php');
  require_once(__DIR__.'/views/view_bottom.php');
  exit();
}

// ##################################################
post('/login', 'login');
function login(){
  require_once(__DIR__.'/bridges/bridge_login.php');
  exit();
}

// ##################################################
any('/404', 'error404');
function error404(){
  echo 'Not found';
  exit();
}