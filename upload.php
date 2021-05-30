<?php

// echo print_r($_FILES['my_picture']);
// echo "<div>{$_FILES['my_picture']['name']}</div>"; // coderspage.png
// echo "<div>{$_FILES['my_picture']['type']}</div>"; // image/png
// echo "<div>{$_FILES['my_picture']['tmp_name']}</div>"; // C:\xampp\tmp\php8B68.tmp
// echo "<div>{$_FILES['my_picture']['size']}</div>"; //14657
// $image_file_type = strtolower(pathinfo($_FILES['my_picture']['name'], PATHINFO_EXTENSION));

$valid_extensions = ['png', 'jpg', 'jpeg', 'gif', 'zip', 'pdf'];

$image_type = mime_content_type($_FILES['my_picture']['tmp_name']); // image/png
$extension = strrchr($image_type, '/'); // /png ... /tmp ... /jpg
$extension = ltrim($extension, '/'); // png ... jpg ... plain

if (!in_array($extension, $valid_extensions)) {
    echo "mmm.. hacking me?";
    exit();
}

$random_image_name = bin2hex(random_bytes(16)) . ".$extension";
move_uploaded_file($_FILES['my_picture']['tmp_name'], "img/$random_image_name");
echo 'File uploaded';
