<?php

require_once "../../../vendor/autoload.php";

use App\controllers\AuthController;

session_start();
$logout = new AuthController("", "");

$logout->logout();
