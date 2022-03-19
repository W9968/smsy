<?php
include "../utils/connect.php";

$_id = $_GET['_id'];
$db->exec("DELETE FROM table_students where id='$_id'");
header('Location: ../admin/index.php');
