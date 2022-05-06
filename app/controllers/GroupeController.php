<?php

namespace App\controllers;

use App\helper\DataBase;
use App\models\Groupe;
use Exception;

class GroupeController {

    public function findMany() {
        try {
            return DataBase::connect()->query("SELECT * FROM `table_class`");
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function findOne($id) {
        try {
            return DataBase::connect()->query("SELECT * FROM `table_class` WHERE `_uid`='$id'")->fetch();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function store(Groupe $req) {
        try {
            DataBase::connect()->prepare("INSERT INTO `table_class`(_uid, `class_name`, `class_level`, `class_capcity`, `dep_id`) VALUES(NULL, ?, ?, ?, ?)")->execute([$req->getName(), $req->getLevel(), $req->getCapacity(), $req->getDep()]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function delete($id) {
        try {
            DataBase::connect()->prepare("DELETE FROM `table_class` WHERE `_uid`=? ")->execute([$id]);
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    public function update(Groupe $req, $id) {
        try {
            DataBase::connect()->prepare("UPDATE `table_class` SET `class_name`=?, `class_level`=?, `class_capcity`=?, `dep_id`=? WHERE `_uid`=?")->execute([$req->getName(), $req->getLevel(), $req->getCapacity(), $req->getDep(), $id]);
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

}