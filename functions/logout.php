<?php

session_start();
session_unset();
session_destroy();
header("Location: ../auth/login.php");
setcookie("AUTH_SESSON", "loggedout", time() - 3600, "/");
