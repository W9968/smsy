<?php

include "../utils/connect.php";

$filiere        = $_POST['filiere'];
$pricing        = $_POST['paiment'];

if (isset($_POST['ajouter'])) {

    try {

        $query = $db->prepare("INSERT INTO `table_faculty` (`_uid`, `faculty_name`, `faculty_price`, `_createdAt`) 
        VALUES (NULL, ?, ?, current_timestamp())");

        if ($query->execute([$filiere, $pricing])) {

            header('Location: ../admin/mod/add_faculty.php');
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
