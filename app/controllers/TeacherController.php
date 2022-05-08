<?php

namespace App\controllers;

use App\helper\DataBase;
use App\models\Teacher;
use Exception;

class TeacherController extends UserController
{

    public function findMany()
    {
        try {
            return DataBase::connect()->query("SELECT * FROM `table_users` WHERE `role`= 'TEACHER'");
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getNonAssignedTeacher()
    {
        try {
            return DataBase::connect()->query("SELECT A.* FROM table_users A WHERE NOT EXISTS(SELECT user_id FROM table_teacher B WHERE B.user_id=A._uid) AND A.role='TEACHER' ");
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getAssignedTeacher()
    {
        try {
            return DataBase::connect()->query("SELECT U.* FROM `table_users` U, `table_teacher` S WHERE U._uid = S.user_id");
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function assign(Teacher $req): void
    {
        try {;
            DataBase::connect()->prepare("INSERT INTO `table_teacher` (`_uid`, `salary`, `class_id`, `user_id`)  VALUES (NULL, ?, ?, ?)")->execute([$req->getSalary(), $req->getClassId(), $req->getUserId()]);
            DataBase::connect()->prepare("UPDATE `table_users` SET `restriction`='0' WHERE `_uid`=?")->execute([$req->getUserId()]);
            header("Location: .");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function findStudentProfile($id)
    {
        try {
            return DataBase::connect()->query("SELECT class_id, cin, profile_picture, first_name, last_name, email, state, city, zip, gender, adress1, adress2, birth, phone, salary, class_name, class_level, dep_id FROM table_users tu JOIN table_teacher ts on tu._uid = ts.user_id JOIN table_class tc on tc._uid = ts.class_id WHERE tu._uid = '$id'")->fetch();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
