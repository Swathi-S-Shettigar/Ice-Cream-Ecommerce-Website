<?php
$db_name = 'mysql:host=localhost;dbname=icecream_db';
$user_name = 'root';
$user_password = '';
$conn = new PDO($db_name, $user_name, $user_password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (!$conn) {
    echo "Not connected successfully";
}

function unique_id() {
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charLength = strlen($chars);
    $randomString = '';
    for ($i = 0; $i < 20; $i++) {
        $randomString .= $chars[mt_rand(0, $charLength - 1)];
    }
    return $randomString;
}
?>
