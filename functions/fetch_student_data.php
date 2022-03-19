<?php
include "../utils/connect.php";

$queries = $db->query("SELECT _uid, cin, role, email, name,prenom , gender, profile_picture, address_1, address_2, city, state, zip, restriction FROM table_users, table_students WHERE table_users._uid =  table_students.table_user")->fetchAll();
