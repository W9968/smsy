<?php

namespace App\controllers;

use App\helper\DataBase;
use App\models\Subject;
use Exception;

class SubjectController
{

    public function findMany() {
        try {
            return DataBase::connect()->query("SELECT * FROM `table_subject`");
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function findOne($id) {
        try {
            return DataBase::connect()->query("SELECT * FROM `table_subject` WHERE `subject_name`='$id'")->fetch();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function store(Subject $req) {
        try {
            DataBase::connect()->prepare("INSERT INTO `table_subject`(`subject_name`, `duration`) VALUES (?,?)")->execute([$req->getName(), $req->getDuraiton()]);
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    public function update(Subject $req, $id) {
        try {
            DataBase::connect()->prepare("UPDATE `table_subject` SET `subject_name`=?, `duration`=? WHERE `subject_name`=?")->execute([$req->getName(), $req->getDuraiton(),$id]);
        } catch(Exception $e) {
            echo $e->getMessage();
        }

    }

    public function delete($id) {
        try {
            DataBase::connect()->prepare("DELETE FROM `table_subject` WHERE `subject_name`=?")->execute([$id]);
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

}