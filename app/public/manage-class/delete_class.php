<?php

require_once "../../../vendor/autoload.php";
use App\controllers\GroupeController;

$_id = $_GET['class_id'];
$payload = new GroupeController();

$payload->delete($_id);
header("Location: class.php");
