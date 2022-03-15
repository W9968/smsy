<?php
$cookie_value = "a-users";
setcookie("routing", $cookie_value, time() + (86400 * 30), "/");

include "../functions/fetch_user_data.php"

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../styles/datatable.module.css?v=<?php echo time(); ?>">
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="../../javascript/fallbacks.js"></script>
</head>


<body>

    <div class="form-container">
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>cin</th>
                        <th>nom</th>
                        <th>prenom</th>
                        <th>role</th>
                        <th style="width:42px"></th>
                        <th style="width:42px"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($queries as $value) {
                        echo "<tr>";
                        echo "<td>" . $value['_uuid'] . "</td>";
                        echo "<td>" . $value['name'] . "</td>";
                        echo "<td>" . $value['prenom'] . "</td>";
                        echo "<td>" . $value['guard'] . "</td>";
                        echo "<td><button id=edit><i style='width:18px;' data-feather='edit'></i></button></td>";
                        echo "<td><button id=delete><i style='width:18px;' data-feather='delete'></i></button></td>";
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
                    <br/>Vous êtes sûr de supprimer cet utilisateur [" . $value['_uuid'] . "] ?
                </p>
                <div class=modal-btn-grid >
                    <button class=modal-cancel-delete >annuler</button>
                    <a href='../functions/delete_account.php?_id=" . $value['id'] . "' >
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