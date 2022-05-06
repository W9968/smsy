<?php

namespace App\controllers;

use App\helper\DataBase;
use App\models\Student;
use Exception;

class StudentController extends UserController
{

    public function findMany()
    {
        try {
            return DataBase::connect()->query("SELECT * FROM `table_users` WHERE `role`= 'STUDENT'");
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getNonAssignedStudent()
    {
        try {
            return DataBase::connect()->query("SELECT A.* FROM table_users A WHERE NOT EXISTS(SELECT user_id FROM table_student B WHERE B.user_id=A._uid) AND A.role='STUDENT' ");
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getAssignedStudent()
    {
        try {
            return DataBase::connect()->query("SELECT U.* FROM `table_users` U, `table_student` S WHERE U._uid = S.user_id");
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function assign(Student $req): void
    {
        try {
            DataBase::connect()->prepare("INSERT INTO `table_student` (`_uid`, `class_id`, `user_id`, `paied`, `enrolled`)  VALUES (NULL, ?, ?, ?, current_timestamp())")->execute([$req->getClassId(), $req->getUserId(), $req->getPayment()]);
            header("Location: .");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function findStudentProfile($id)
    {
        try {
            return DataBase::connect()->query("SELECT class_id, cin, profile_picture, first_name, last_name, email, state, city, zip, gender, adress1, adress2, birth, phone, enrolled, class_name, class_level, dep_id FROM table_users tu JOIN table_student ts on tu._uid = ts.user_id JOIN table_class tc on tc._uid = ts.class_id WHERE tu._uid = '$id'")->fetch();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getClasses($slug)
    {
        try {
            return DataBase::connect()->query("SELECT * FROM table_class_subject tcs WHERE tcs.class_id = '$slug' ORDER BY tcs.begin_period  ");
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
