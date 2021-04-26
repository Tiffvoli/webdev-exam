<?php

// Validate
if( ! isset($_POST['search_for']) ){
  http_response_code(400);
  exit();
}


