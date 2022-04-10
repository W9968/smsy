<?php

include "../utils/connect.php";

$cin        = $_POST['cin'];
$email      = $_POST['email'];
$first_name = $_POST['nom'];
$last_name  = $_POST['prenom'];
$gender     = $_POST['r1'];
$add1       = $_POST['add1'];
$add2       = $_POST['add2'];
$city       = $_POST['cite'];
$state      = $_POST['state'];
$zip        = $_POST['zip'];
$role       = $_POST['role'];
$password   = md5($cin);

$brith      = '2022-03-20';
$file_name = $_FILES['file_upload']['name'];
$file_temp_name  = $_FILES['file_upload']['tmp_name'];
$new_image_name = time() . basename($file_name);
$upload_path = "../uploads/" . $new_image_name;

if (isset($_POST['ajouter'])) {

    try {

        $query = $db->prepare("INSERT INTO `table_users` (`_uid`, `cin`, `password`, `role`, `restriction`, `profile_picture`, 
        `first_name`, `last_name`, `email`, `state`, `city`, `zip`, `gender`, `adress1`, `adress2`, `birth`, `_createdAt`) 
        VALUES (NULL, ?, ?, ?, '0', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '2022-03-21', current_timestamp())");

        if ($query->execute([$cin, $password, $role, $new_image_name, $first_name, $last_name, $email, $state, $city, $zip, $gender, $add1, $add2])) {
            move_uploaded_file($file_temp_name, $upload_path);
            header('Location: ../admin/mod');
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
