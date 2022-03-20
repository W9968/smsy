<?php
include "../utils/connect.php";

$queries = $db->query("SELECT * FROM `table_users`")->fetchAll();
