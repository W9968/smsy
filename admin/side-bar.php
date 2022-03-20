<?php
include "../utils/connect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../styles/sidebar.module.css?v=<?php echo time(); ?>">
    <script src="../javascript/sideBar.js"></script>
    <script src=" https://unpkg.com/feather-icons"></script>
</head>

<body>
    <div class="nav-bar">
        <h2>EPI</h2>
        <!-- <div class="links" id="link-usage">
            <?php
            foreach (array(
                "student" => ["information" => "information", "emploi de temp" => "timing", "note matiere" => "note"],
                "teacher" => ["classes" => "classes", "emploi de temp" => "timing"],
                "administrator" => ["users" => "manage-users"]
            ) as $key => $value) {
                echo "<p>$key</p>";
                echo "<div>";
                foreach ($value as $element => $el) {
                    echo "<a href='./$key/$el.php'>$element</a>";
                }
                echo "</div>";
            }
            ?>
        </div> -->
        <form action="../functions/logout.php" method="POST">
            <button name="">deconnecter</button>
        </form>
    </div>
</body>

</html>