<?php

require_once("../../utils/connect.php");
$queries = Connect::database()->query("SELECT * FROM `table_users`")->fetchAll();
$student_queries = Connect::database()->query("SELECT * FROM `table_users` TU, `table_student` TS  INNER JOIN `table_class` TC ON TC._uid=TS.class_id WHERE TU._uid=TS.user_id")->fetchAll();
if (isset($_POST['ajouter-user'])) {
    header('Location: ./add_user.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../../styles/datatable.module.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../styles/form.module.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../styles/dash.module.css?v=<?php echo time(); ?>">
    <script src="https://unpkg.com/feather-icons"></script>
    <title>Dashboard</title>
</head>


<body>

    <div class="dashboard">

        <div class="navbar">
            <?php include "../../views/adminnav.php" ?>
        </div>

        <div class="content">
            <div class="form">
                <h1>Etudiants</h1>
                <br />
                <div class="table">
                    <?php
                    if (empty($student_queries))
                        echo "no data";
                    else {
                    ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>photo</th>
                                    <th>cin</th>
                                    <th>classe</th>
                                    <th>nom</th>
                                    <th style="width:24px"></th>
                                    <th style="width:24px"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php

                            foreach ($student_queries as $value) {
                                echo "<tr>";
                                echo "<td><img alt=profile-picture src='../../uploads/" . $value['profile_picture'] . "' /></td>";
                                echo "<td>" . $value['cin'] . "</td>";
                                echo "<td>" . $value['class_level'] . $value['class_name'] . "</td>";
                                echo "<td>" . $value['last_name'] . " " . $value['first_name'] . "</td>";
                                echo "<td><button id=edit><i style='width:18px;' data-feather='edit'></i></button></td>";
                                echo "<td><button id=delete><i style='width:18px;' data-feather='trash'></i></button></td>";
                            }
                        }   ?>
                            </tbody>
                        </table>
                </div>
            </div>


            <div class="form-container">
                <form method="post" class="header">
                    <h1>comptes utilisateurs</h1>
                    <button name="ajouter-user">ajouter</button>
                </form>

                <div class="table">
                    <?php
                    if (empty($queries))
                        echo "no data";
                    else {
                    ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>photo</th>
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

                            foreach ($queries as $value) {
                                echo "<tr>";
                                echo "<td><img alt=profile-pciture src='../../uploads/" . $value['profile_picture'] . "' /></td>";
                                echo "<td>" . $value['cin'] . "</td>";
                                echo "<td>" . $value['email'] . "</td>";
                                echo "<td>" . $value['last_name'] . "</td>";
                                echo "<td>" . $value['first_name'] . "</td>";
                                echo "<td>" . $value['gender'] . "</td>";
                                echo "<td>" . $value['city'] . "</td>";
                                echo "<td>" . $value['state'] . "</td>";
                                echo "<td>" . $value['adress1'] . "</td>";
                                if ($value['adress2'] != null) echo "<td>" . $value['adress2']  . "</td>";
                                else echo "<td><p style=color:#979797>N/A</p></td>";
                                echo "<td>" . $value['role'] . "</td>";
                                echo "<td>" . $value['birth'] . "</td>";
                                if ($value['role'] == 'STUDENT') echo "<td> <a href='./assign_student.php?_id=" . $value['_uid'] . "' ><button id=assign><i style='width:18px;' data-feather='plus-square'></i></button></a></td>";
                                else if ($value['role'] == 'TEACHER') echo "<td> <a href='./assign_teacher.php?_id=" . $value['_uid'] . "' ><button id=assign><i style='width:18px;' data-feather='plus-square'></i></button></a></td>";
                                else echo "<td></td>";
                                echo "<td><button id=delete><i style='width:18px;' data-feather='trash'></i></button></td>";
                                if ($value['restriction'] == 0) echo "<td><button id=block><i style='width:18px;' data-feather='shield'></i></button></td>";
                                else echo "<td><button id=block><i style='width:18px;' data-feather='shield-off'></i></button></td>";
                                echo "</tr>";
                            }
                        }   ?>
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
                    <a href='../../functions/account_delete.php?_id=" . $value['_uid'] . "' >
                        <button class=modal-confirm-delete >supprimer</button>
                    </a>
                </div>
            </div>";
                }
                ?>
            </div>
        </div>
    </div>
    <script src="../../javascript/showModel.js"></script>
    <script src="../../config/feather.config.js"></script>
</body>

</html>