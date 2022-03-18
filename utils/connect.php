<?php
$db_username = "root";
$db_server = "127.0.0.1";
$db_name = "school-management-system";
$db_password = "";

try {
    $db = new PDO("mysql:host=$db_server; dbname=$db_name", $db_username, $db_password);
} catch (PDOException $e) {
    echo "error" . $e->getMessage();
    die();
}
