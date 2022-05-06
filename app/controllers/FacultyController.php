<?php

namespace App\controllers;

use App\helper\DataBase;
use App\models\Faculty;
use Exception;

class FacultyController {

    public function findMany() {
        try {
            return Database::connect()->query("SELECT * FROM `table_faculty` ");
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function findOne($id) {
        try {
            return DataBase::connect()->query("SELECT * FROM `table_faculty` WHERE `faculty_name`='$id'")->fetch();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function store(Faculty $req) {
        try {
            DataBase::connect()->prepare("INSERT INTO `table_faculty` (`faculty_name`, `faculty_price`, `_createdAt`) 
            VALUES (?, ?, current_timestamp())")->execute([$req->getName(), $req->getPrice()]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function delete($id) {
        try {
            Database::connect()->prepare("DELETE FROM `table_faculty` where `faculty_name`=?")->execute([$id]);
        } catch(Exception $e) {
            echo  $e->getMessage();
        }
    }
    
    public function update(Faculty $req, $id) {
        try {
          DataBase::connect()->prepare("UPDATE `table_faculty` SET `faculty_name`=?, `faculty_price`=? WHERE `faculty_name`=?")->execute([$req->getName(), $req->getPrice(),$id]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}