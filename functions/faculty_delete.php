<?php
include "../utils/connect.php";

$_id = $_GET['_id'];
$db->exec("DELETE FROM `table_faculty` where _uid='$_id'");
header('Location: ../admin/mod/add_faculty.php');
