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
}
