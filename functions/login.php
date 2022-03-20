<?php
session_start();
include "../utils/connect.php";


if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == "true") {
    header('Location: ../admin/');
} else {
    $_SESSION['loggedin'] = "fasle";
    setcookie("AUTH_SESSON", "loggedout", time() - 3600, "/");
}


if (isset($_POST['connecter'])) {
    $login_uuid = $_POST['cin'];
    $login_pass = md5($_POST['password']);

    try {
        $query = $db->prepare("SELECT `cin`, `password`, `role` FROM `table_users` WHERE `cin`=:id AND `password`=:pass  ");
        $query->bindParam("id", $login_uuid, PDO::PARAM_STR);
        $query->bindValue("pass", $login_pass, PDO::PARAM_STR);
        $query->execute();

        $rowCounnt = $query->rowCount();
        $row = $query->fetch(PDO::FETCH_ASSOC);

        if ($rowCounnt == 1 && !empty($row)) {
            $_SESSION['loggedin'] = "true";
            $_SESSION['CurrentUserRole'] = $row['role'];
            $cookie_value = md5($row['cin'] . $row['password']);
            setcookie("AUTH_SESSON", $cookie_value, time() + (86400 * 30), "/");
            header('Location: ../admin/');
        } else {
            print("invalid login");
        }
    } catch (PDOException $e) {
        print_r($e->getMessage());
    }
}
