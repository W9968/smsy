<?php
require_once("../../utils/connect.php");

$_id = $_GET['_id'];
$res =  Connect::database()->query("SELECT * FROM `table_users` WHERE _uid='$_id'")->fetch();
$queries = Connect::database()->query("SELECT * FROM `table_class`")->fetchAll();

if (isset($_POST['inscrire'])) {
    try {

        $query = Connect::database()->prepare("INSERT INTO `table_student` (`_uid`, `class_id`, `user_id`, `enrolled`)  VALUES (NULL, ?, ?, current_timestamp())");

        if ($query->execute([$_POST['section'], $res['_uid']])) {
            header('Location: ./index.php');
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../../styles/form.module.css?v=<?php echo time() ?>">
    <title>ajouter edtudiant</title>
</head>

<body>
    <form action="" method="post" class="form" enctype="multipart/form-data">
        <h1>affecter un étudiant</h1><br />
        <div>

            <div style="display:flex;flex-direction:row;">
                <img style="display:flex;" alt="profile picture" height="200px" width="200px" src="../../uploads/<?php echo $res['profile_picture'] ?>" />
                <div style="flex:1;">
                    <div class="fiche">
                        <p><b>CIN</b></p>
                        <p><?php echo $res['cin'] ?></p>
                    </div>
                    <div class="fiche">
                        <p><b>COURIER</b></p>
                        <p><?php echo $res['email'] ?></p>
                    </div>
                    <div class="fiche">
                        <p><b>NOM</b></p>
                        <p><?php echo $res['first_name'] ?></p>
                    </div>
                    <div class="fiche">
                        <p><b>PRENOM</b></p>
                        <p><?php echo $res['last_name'] ?></p>
                    </div>
                </div>
            </div>
            <br /><br />
            <div class="form-group">
                <label>type</label>
                <label>
                    <select class="selection" name="section" required>
                        <option value="" disabled selected>selectionner option</option>
                        <?php
                        foreach ($queries as $value) {
                            echo "<option value=" . $value['_uid'] . ">" . $value['class_level'] . $value['class_name'] . "</option>";
                        }
                        ?>
                    </select>
                </label>
            </div>
            <div class="form-group">
                <button type="submit" name="inscrire">inscrire</button>
            </div>
        </div>
    </form>

    <script src="../../javascript/fileReader.js"></script>
</body>

</html>