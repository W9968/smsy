<?php

include "../utils/connect.php";

$level        = $_POST['niveau'];
$class        = $_POST['classe'];
$capacity     = $_POST['capcite'];

if (isset($_POST['ajouter'])) {

    try {

        $query = $db->prepare("INSERT INTO `table_class` (`_uid`, `class_name`, `class_level`, `class_capcity`) 
        VALUES (NULL, ?, ?, ?)");

        if ($query->execute([$class, $level, $capacity])) {

            header('Location: ../admin/mod/add_classes.php');
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
