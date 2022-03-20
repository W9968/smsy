<?php
include "../utils/connect.php";

$array = array_filter(
    array(
        "student" => ["information" => "information", "emploi de temp" => "timing", "note matiere" => "note"],
        "teacher" => ["classes" => "classes", "emploi de temp" => "timing"],
        "staff" => ["Gestion Etudiant" => "studient-list", "Gestion Enseignant" => "techaer-list"],
        "administrator" => ["users" => "manage-users"]
    ),
    function ($elem) {
        return strtoupper($elem) == $_SESSION['currentUserRole'];
    },
    ARRAY_FILTER_USE_KEY

);

$cin = $_SESSION['currentUserUuid'];
$res = $db->query("SELECT * FROM `table_users` WHERE `cin`='$cin' ")->fetch();
$_SESSION['currentUserUuid'] = $res['cin'];
if (!$res) {
    include "../functions/logout.php";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../styles/sidebar.module.css?v=<?php echo time(); ?>">
    <script src=" https://unpkg.com/feather-icons"></script>
    <script src="../javascript/fallbacks.js"></script>
</head>

<body>
    <div class="navigation-bar">
        <h2><?php echo $_SESSION['currentUserRole'] ?></h2>
        <div>
            <div class="menu-toggler">
                <button type="submit" class="menu">
                    <i style="width:18px;height:18px;" data-feather="menu"></i>
                </button>
                <div class="menu-drop display">
                    <a class="profile">
                        <?php if ($res['profile_picture'] == NULL)
                            echo "<img src='../assets/default_profile.jpg' >";
                        else
                            echo "<img src='../uploads/" . $res['profile_picture'] . "' >"
                        ?>
                        <p><?php echo $res['first_name'] . " " . $res['last_name'] ?></p>
                    </a>
                    <form action="../functions/logout.php" method="post">
                        <button class="logout">deconnecter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="links" id="link-usage">
        <?php
        foreach ($array as $key => $value) {
            echo "<ul>";
            foreach ($value as $element => $el) {
                echo "<li><a href='./$key/$el.php'>$element</a></li>";
            }
            echo "</ul>";
        }
        ?>
    </div>

    <script src="../config/feather.config.js"></script>
    <script src="../javascript/sideBar.js"></script>
</body>

</html>