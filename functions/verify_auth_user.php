<?php

session_start();
include "../utils/connect.php";

if ($_SESSION['loggedin'] != "true") {
    header("Location: ../auth/login.php");
}
