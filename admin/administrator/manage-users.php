<?php
$cookie_value = "a-users";
setcookie("routing", $cookie_value, time() + (86400 * 30), "/");


if (isset($_POST['ajouter-user'])) {
    header('Location: ./administrator/add-users.php');
}

include "../functions/fetch_student_data.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../styles/datatable.module.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/form.module.css?v=<?php echo time(); ?>">
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="../../javascript/fallbacks.js"></script>
</head>


<body>

    <div class="form-container">
        <form method="post" class="header">
            <h1>comptes utilisateurs</h1>
            <div>
                <button>filtrer</button>
                <button name="ajouter-user">ajouter</button>
            </div>
        </form>
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>cin</th>
                        <th>email</th>
                        <th>nom</th>
                        <th>prenom</th>
                        <th>sex</th>
                        <th>cite</th>
                        <th>state</th>
                        <th>address</th>
                        <th>address2</th>
                        <th>role</th>
                        <th>naissance</th>
                        <th style="width:24px"></th>
                        <th style="width:24px"></th>
                        <th style="width:24px"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (empty($queries))
                        echo "no data";
                    else
                        foreach ($queries as $value) {
                            echo "<tr>";
                            echo "<td>" . $value['cin'] . "</td>";
                            echo "<td>" . $value['email'] . "</td>";
                            echo "<td>" . $value['first_name'] . "</td>";
                            echo "<td>" . $value['first_name'] . "</td>";
                            echo "<td>" . $value['gender'] . "</td>";
                            echo "<td>" . $value['city'] . "</td>";
                            echo "<td>" . $value['state'] . "</td>";
                            echo "<td>" . $value['adress1'] . "</td>";
                            if ($value['adress2'] != null) echo "<td>" . $value['adress2']  . "</td>";
                            else echo "<td><p style=color:#979797>N/A</p></td>";
                            echo "<td>" . $value['role'] . "</td>";
                            echo "<td>" . $value['birth'] . "</td>";
                            echo "<td><button id=edit><i style='width:18px;' data-feather='edit'></i></button></td>";
                            echo "<td><button id=delete><i style='width:18px;' data-feather='trash'></i></button></td>";
                            if ($value['restriction'] == 0) echo "<td><button id=block><i style='width:18px;' data-feather='shield'></i></button></td>";
                            else echo "<td><button id=block><i style='width:18px;' data-feather='shield-off'></i></button></td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
        foreach ($queries as $value) {
            echo "<div class=modal-delete>
                <p>
                    <i style='align-self:start;height:24px;width:24px;color:#e91f63;margin-bottom:5px' data-feather='x-square'></i>
                    <br/>Vous êtes sûr de supprimer cet utilisateur [" . $value['_uid'] . "] ?
                </p>
                <div class=modal-btn-grid >
                    <button class=modal-cancel-delete >annuler</button>
                    <a href='../functions/delete_account.php?_id=" . $value['_uid'] . "' >
                        <button class=modal-confirm-delete >supprimer</button>
                    </a>
                </div>
            </div>";
        }
        ?>
    </div>

    <script src="../javascript/showModel.js"></script>
    <script src="../config/feather.config.js"></script>
</body>

</html>