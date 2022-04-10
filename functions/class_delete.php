<?php
include "../utils/connect.php";

$_id = $_GET['_id'];
$db->exec("DELETE FROM `table_class` where _uid='$_id'");
header('Location: ../admin/mod/add_classes.php');
