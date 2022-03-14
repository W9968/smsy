<?php
include "../utils/connect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/backoffice.module.css?v=<?php echo time(); ?>">
    <title>Dashboard</title>
</head>

<body>
    <div class="container">
        <div class="side-nav">
            <?php include "./side-bar.php" ?>
        </div>
        <div class="content">
            <?php
            if (isset($_COOKIE['routing'])) {
                switch ($_COOKIE['routing']) {
                    case 's-info':
                        return include "./student/information.php";
                        break;
                    case 's-note':
                        return include "./student/note.php";
                        break;
                    case 's-timing':
                        return include "./student/timing.php";
                        break;
                }
            } else echo "no no"
            ?>
        </div>
    </div>
</body>

</html>