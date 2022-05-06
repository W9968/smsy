<?php

require_once "../../../vendor/autoload.php";

use App\controllers\UserController;

$_id = $_GET['user_id'];
$payload = new UserController('', '');

$payload->delete($_id);
header("Location: users.php");
