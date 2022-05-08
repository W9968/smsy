<?php

namespace App\controllers;

use App\helper\DataBase;
use App\models\User;
use Exception;

class UserController extends AuthController
{

    public function findMany()
    {
        try {
            return Database::connect()->query("SELECT * FROM `table_users`");
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function findOne($id)
    {
        try {
            return DataBase::connect()->query("SELECT * FROM `table_users` WHERE `_uid`='$id'")->fetch();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete(string $id)
    {
        try {
            Database::connect()->prepare("DELETE FROM `table_users` where `_uid`=?")->execute([$id]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function store(User $req)
    {
        try {
            DataBase::connect()->prepare("INSERT INTO `table_users` (`_uid`, `cin`, `password`, `role`, `restriction`, `profile_picture`, `first_name`, `last_name`, `email`, `state`, `city`, `zip`, `gender`, `adress1`, `adress2`, `birth`, `phone`, `_createdAt`) 
            VALUES (NULL, ?, ?, ?, '1', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, current_timestamp())")->execute([
                $req->getCin(), $req->getPassword(), $req->getRole(), $req->getPicture(), $req->getFistName(), $req->getLastName(), $req->getEmail(), $req->getState(), $req->getState(), $req->getZip(), $req->getGender(), $req->getAddress1(), $req->getAddress2(), $req->getBirth(), $req->getPhone()
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function Revenue()
    {
        try {
            return DataBase::connect()->query("SELECT SUM(`paied`), SUM(`salary`) FROM `table_student`, `table_teacher`")->fetch();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
