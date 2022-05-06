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
}
