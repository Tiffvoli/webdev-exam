<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/router.php');

// ##############################
get('/', 'views/view_index.php');
get('/admin', 'views/view_admin.php');
get('/email', 'views/view_email.php');
get('/login', 'views/view_login.php');
get('/users', 'views/view_users.php');
get('/search', 'views/view_search.php');
get('/signup', 'views/view_signup.php');





// ##############################
// ##############################
// ##############################
post('/deactive-account', 'views/deactivate_account.php');
post('/login', 'bridges/bridge_login.php');
post('/search', 'apis/api-search.php');
post('/signup', 'bridges/bridge_signup.php');

// ##############################
// post('/users/update/:id', function($id){
//   echo "Updating user with id: $id";
// });

post('/users/delete/$user_id', 'apis/api_delete_user.php');
post('/db-create-users', 'db/db_create_users.php');
post('/db-seed-users', 'db/db_seed_users.php');

any('/404', 'views/view_404.php');

