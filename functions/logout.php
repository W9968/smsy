<?php

session_start();
session_unset();
session_destroy();
setcookie("AUTH_SESSON", "loggedout", time() - 3600, "/");
header("Location: ../auth/login.php");
