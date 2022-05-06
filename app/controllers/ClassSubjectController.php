<?php

namespace App\controllers;

use App\helper\DataBase;
use App\models\ClassSubject;
use Exception;

class ClassSubjectController
{
    public function findMany() {
        try {
            return DataBase::connect()->query("SELECT * FROM `table_class_subject`");
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function findOne($id) {
        try {
            return DataBase::connect()->query("SELECT * FROM `table_class_subject` WHERE  `_uid`='$id'");
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function store(ClassSubject $req) {
        try {
            DataBase::connect()->prepare("INSERT INTO `table_class_subject`(`_uid`,`class_id`,`subject_id`,`begin_period`) VALUES (NULL, ?, ?, ?)")->execute([$req->getClassId(), $req->getSubjectId(), $req->getStartsAt()]);
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    public function update(ClassSubject $req, $id) {
        try {
            DataBase::connect()->prepare("UPDATE `table_class_subject` SET `class_id`=?, `subject_id`=?, `begin_period`=? WHERE `_uid`=?")->execute([$req->getClassId(), $req->getSubjectId(), $req->getStartsAt(), $id]);
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    public function delete($id) {
        try {
            DataBase::connect()->prepare("DELETE FROM `table_class_subject` WHERE `_uid`=?")->execute([$id]);
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

}