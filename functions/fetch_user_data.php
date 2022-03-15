<?php
include "../utils/connect.php";

$queries = $cnx->query("SELECT * FROM table_users")->fetchAll();
