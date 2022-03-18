<?php
include "../utils/connect.php";

$cin        = $_POST['cin'];
$email      = $_POST['email'];
$pass       = md5($_POST['password']);
$first_name = $_POST['nom'];
$last_name  = $_POST['prenom'];
$gender     = $_POST['r1'];
$add1       = $_POST['add1'];
$add2       = $_POST['add2'];
$city       = $_POST['cite'];
$state      = $_POST['state'];
$zip        = $_POST['zip'];
$role       = $_POST['role'];


if (isset($_POST['ajouter'])) {

    $statement = "INSERT INTO table_users
    (id, _uuid, email, password, name, prenom, gender, 
    profile_picture, address_1, address_2, city, state, zip, guard, restriction) 
    VALUES (NULL, :_uuid, :email, :passowrd, :name, :prenom, :gender, 
    'profile_picture', :address_1, :address_2, :city, :state , :zip , :role, '0')";

    $query = $db->prepare($statement);
    $query->bindParam(':_uuid', $cin);
    $query->bindParam(':email', $email);
    $query->bindParam(':passowrd', $pass);
    $query->bindParam(':name', $last_name);
    $query->bindParam(':prenom', $first_name);
    $query->bindParam(':gender', $gender);
    // $query->bindParam(':profile_picture');
    $query->bindParam(':address_1', $add1);
    $query->bindParam(':address_2', $add2);
    $query->bindParam(':city', $city);
    $query->bindParam(':state', $state);
    $query->bindParam(':zip', $zip);
    $query->bindParam(':role', $role);

    $query->execute();
    header('Location: ../admin');
}
