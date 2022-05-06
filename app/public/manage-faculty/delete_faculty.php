<?php

require_once "../../../vendor/autoload.php";
use App\controllers\FacultyController;

$_id = $_GET['faculty_id'];
$payload = new FacultyController();

$payload->delete($_id);
header("Location: faculty.php");
