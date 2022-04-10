<?php
include "../utils/connect.php";

$_id = $_GET['_id'];
$query = $db->query("SELECT * FROM `table_faculty` WHERE _uid='$_id'")->fetch();

if (isset($_POST['modifier'])) {
    $faculty = $_POST['filiere'];
    $pricing = $_POST['paiment'];
    try {
        $update = $db->prepare("UPDATE `table_faculty` SET `faculty_name`=?, `faculty_price`=? WHERE _uid='$_id'");
        if ($update->execute([$faculty, $pricing])) {
            header('Location: ../admin/mod/add_faculty.php');
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
        <h1>modifier une filiere</h1>

        <div class="fom-group">
            <p class="intro">en tant qu'un adminitrateur, vous serez capable d'ajouter des filiere different.</p>
        </div>

        <div class="form-group">
            <label for="nom">filiere</label>
            <input type="text" placeholder="filiere..." name="filiere" id="filiere" value="<?php echo $query['faculty_name'] ?>" required>
        </div>

        <div class="form-group">
            <label for="paiment">facture</label>
            <input type="text" placeholder="paiment..." name="paiment" id="paiment" value="<?php echo $query['faculty_price'] ?>" required>
        </div>


        <div class="form-group">
            <button type="submit" name="modifier">modifier</button>
        </div>
    </form>
</body>

</html>