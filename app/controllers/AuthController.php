<?php

namespace App\controllers;

use App\helper\DataBase;
use Exception;
use PDO;

class AuthController
{

    private $email;
    private $password;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function login(): void
    {
        try {
            $request = Database::connect()->prepare("SELECT `_uid`, `email`, `role` from `table_users` WHERE `email`=:email AND `password`=:pass");
            $request->bindParam("email", $this->email, PDO::PARAM_STR);
            $request->bindValue("pass", $this->password, PDO::PARAM_STR);
            $request->execute();

            $count = $request->rowCount();
            $data = $request->fetch(PDO::FETCH_ASSOC);

            if ($count == 1 && !empty($data)) {
                $_SESSION['loggedIn'] = "true";
                $_SESSION['role'] = $data['role'];
                $_SESSION["uuid"] = $data['_uid'];
            } else {
                var_dump("wrong");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * dans cette cas il faut remplacer walee.test par localhost:8000
     * car j'ai fais des configuration de proxy sur mon pc pour que 
     * localhost me redirect sur walee.test
     */
    public function logout(): void
    {
        $_SESSION['loggedIn'] = "false";
        $_SESSION['role'] = 'GUEST';
        $_SESSION["uuid"] = -1;
        // header("Location: http://walee.test/smsy/app/public/auth/");
        header("Location: ../auth/");
    }
}
