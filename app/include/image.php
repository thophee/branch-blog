<?php
define('SAVED_DIRECTORY', $_SERVER['DOCUMENT_ROOT'] . '/assets/images/posts/');
$allowed_extensions = array("jpeg", "jpg", "png");
if (isset($_FILES['img'])) {
    $uploaded_file_name = $_FILES['img']['name'];
    $uploaded_file_size = $_FILES['img']['size'];
    $uploaded_file_tmp = $_FILES['img']['tmp_name'];
    $uploaded_file_type = $_FILES['img']['type'];
    $file_compositions = explode('.', $uploaded_file_name);
    $file_ext = strtolower(end($file_compositions));
    $saved_file_name = $uploaded_file_name;
    move_uploaded_file($uploaded_file_tmp, SAVED_DIRECTORY . $saved_file_name);
    $_POST['img'] = $_FILES['img']['name'];
}

