<?php

require_once "../../../vendor/autoload.php";
use App\controllers\SubjectController;

$_id = $_GET['subject_id'];
$payload = new SubjectController();

$payload->delete($_id);
header("Location: subject.php");