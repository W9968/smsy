<?php
include "../../utils/connect.php";
$queries = $db->query("SELECT * FROM `table_class`")->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../../styles/datatable.module.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../styles/form.module.css?v=<?php echo time() ?>">
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>

    <form action="../../functions/class_add.php" method="post" class="form" enctype="multipart/form-data">
        <h1>ajouter un groupe</h1>

        <div class="fom-group">
            <p class="intro">en tant qu'un adminitrateur, vous serez assigner des groupes.</p>
        </div>

        <div class="form-group">
            <label for="niveau">niveau</label>
            <input type="text" placeholder="niveau..." name="niveau" id="niveau" required>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label for="classe">classe</label>
                <input type="text" placeholder="classe..." name="classe" id="classe" required>
            </div>

            <div class="form-group">
                <label for="capcite">capcite</label>
                <input type="number" placeholder="capcite..." name="capcite" id="capcite" required>
            </div>
        </div>


        <div class="form-group">
            <button type="submit" name="ajouter">ajouter</button>
        </div>

    </form>

    <div class="form">
        <br /><br />
        <div class="table">
            <?php
            if (empty($queries))
                echo "no data";
            else {
            ?>
                <table>
                    <thead>
                        <tr>
                            <th>niveau</th>
                            <th>classe</th>
                            <th>capacite</th>
                            <th style="width:24px"></th>
                            <th style="width:24px"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php

                    foreach ($queries as $value) {
                        echo "<tr>";
                        echo "<td>" . $value['class_level'] . "</td>";
                        echo "<td>" . $value['class_name'] . "</td>";
                        echo "<td>" . $value['class_capcity'] . "</td>";
                        echo "<td><button id=edit><i style='width:18px;' data-feather='edit'></i></button></form></td>";
                        echo "<td><button id=delete><i style='width:18px;' data-feather='trash'></i></button></td>";
                        echo "</tr>";
                    }
                }   ?>
                    </tbody>
                </table>
        </div>
    </div>

    <?php
    foreach ($queries as $value) {
        echo "<div class=modal-delete>
                <p>
                    <i style='align-self:start;height:24px;width:24px;color:#e91f63;margin-bottom:5px' data-feather='x-square'></i>
                    <br/>Vous êtes entrain de supprimer [" . $value['class_level'] . $value['class_name'] . "]
                </p>
                <div class=modal-btn-grid >
                    <button class=modal-cancel-delete >annuler</button>
                    <a href='../../functions/class_delete.php?_id=" . $value['_uid'] . "' >
                        <button class=modal-confirm-delete >supprimer</button>
                    </a>
                </div>
            </div>";
    }
    ?>

    <?php
    foreach ($queries as $value) {
        echo "<div class=modal-edit>
                <p>
                    <i style='align-self:start;height:24px;width:24px;color:#e91f63;margin-bottom:5px' data-feather='edit'></i>
                    <br/>Vous êtes entrain de modifier [" . $value['class_level'] . $value['class_name'] . "]
                </p>
                <div class=modal-btn-grid >
                    <button class=modal-cancel-edit >annuler</button>
                    <a href='../../functions/class_update.php?_id=" . $value['_uid'] . "' >
                        <button class=modal-confirm-edit >modifer</button>
                    </a>
                </div>
            </div>";
    }
    ?>


    <script src="../../javascript/showModel.js"></script>
    <script src="../../config/feather.config.js"></script>
</body>

</html>