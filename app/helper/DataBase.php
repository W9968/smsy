<?php

namespace App\helper;

use PDO;
use PDOException;

class DataBase {

    public static function connect()
    {
        try {
            return new PDO("mysql:host=127.0.0.1; dbname=school-management-system", "root", "");
        } catch (PDOException $e) {
            echo "error" . $e->getMessage();
            return die();
        }
    }

    public function create() {}
}


