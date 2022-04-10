<?php
include "../../utils/connect.php";
$queries = $db->query("SELECT * FROM `table_faculty`")->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../../styles/datatable.module.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../styles/form.module.css?v=<?php echo time() ?>">
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>

    <form action="../../functions/faculty_add.php" method="post" class="form" enctype="multipart/form-data">
        <h1>ajouter une filiere</h1>

        <div class="fom-group">
            <p class="intro">en tant qu'un adminitrateur, vous serez capable d'ajouter des filiere different.</p>
        </div>

        <div class="form-group">
            <label for="filiere">filiere</label>
            <input type="text" placeholder="filiere..." name="filiere" id="filiere" required>
        </div>

        <div class="form-group">
            <label for="paiment">facture</label>
            <input type="text" placeholder="paiment..." name="paiment" id="paiment" pattern="([0-9]{1,3}).([0-9]{1,3})" required>
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
                            <th>filiere</th>
                            <th>facture</th>
                            <th>ouverture</th>
                            <th style="width:24px"></th>
                            <th style="width:24px"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php

                    foreach ($queries as $value) {
                        echo "<tr>";
                        echo "<td>" . $value['faculty_name'] . "</td>";
                        echo "<td id=price-ref>" . $value['faculty_price'] . " TD</td>";
                        echo "<td>" . date("F j, Y, g:i a", strtotime($value['_createdAt'])) . "</td>";
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
                    <br/>Vous êtes entrain de supprimer [" . $value['faculty_name'] . "]
                </p>
                <div class=modal-btn-grid >
                    <button class=modal-cancel-delete >annuler</button>
                    <a href='../../functions/faculty_delete.php?_id=" . $value['_uid'] . "' >
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
                    <br/>Vous êtes entrain de modifier [" . $value['faculty_name'] . "]
                </p>
                <div class=modal-btn-grid >
                    <button class=modal-cancel-edit >annuler</button>
                    <a href='../../functions/faculty_update.php?_id=" . $value['_uid'] . "' >
                        <button class=modal-confirm-edit >modifer</button>
                    </a>
                </div>
            </div>";
    }
    ?>


    <script src="../../javascript/showModel.js"></script>
    <script src="../../javascript/priceRefactor.js"></script>
    <script src="../../config/feather.config.js"></script>
</body>

</html>