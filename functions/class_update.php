<?php
include "../utils/connect.php";

$_id = $_GET['_id'];
$query = $db->query("SELECT * FROM `table_class` WHERE _uid='$_id'")->fetch();

if (isset($_POST['modifier'])) {
    $level        = $_POST['niveau'];
    $class        = $_POST['classe'];
    $capacity     = $_POST['capcite'];

    try {
        $update = $db->prepare("UPDATE `table_class` SET `class_name`=?, `class_level`=?, `class_capcity`=? WHERE _uid='$_id'");
        if ($update->execute([$class, $level, $capacity])) {
            header('Location: ../admin/mod/add_classes.php');
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../styles/form.module.css?v=<?php echo time() ?>">
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>
    <form action="" method="post" class="form" enctype="multipart/form-data">
        <h1>modifier ce classe</h1>

        <div class="fom-group">
            <p class="intro">en tant qu'un adminitrateur, vous serez capable d'ajouter des filiere different.</p>
        </div>

        <div class="fom-group">
            <p class="intro">en tant qu'un adminitrateur, vous serez assigner des groupes.</p>
        </div>

        <div class="form-group">
            <label for="niveau">niveau</label>
            <input type="text" placeholder="niveau..." name="niveau" id="niveau" value="<?php echo $query['class_level'] ?>" required>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label for="classe">classe</label>
                <input type="text" placeholder="classe..." name="classe" id="classe" value="<?php echo $query['class_name'] ?>" required>
            </div>

            <div class="form-group">
                <label for="capcite">capcite</label>
                <input type="number" placeholder="capcite..." name="capcite" id="capcite" value="<?php echo $query['class_capcity'] ?>" required>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" name="modifier">modifier</button>
        </div>

    </form>
</body>

</html>