<?php
$cookie_value = "s-note";
setcookie("routing", $cookie_value, time() + (86400 * 30), "/");
?>

<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body>
    <p>note for student</p>
    <script src="../../javascript/student.js?v=<?php echo time(); ?>"></script>
</body>

</html>