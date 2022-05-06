<?php

namespace App\controllers;

class AuthController
{

    private $email;
    private $password;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function login(): void {
        try {
            $request = Database::connect()->prepare("SELECT `_uid`, `email`, `mdp`, `role` from `table_users` WHERE `email`=:email AND `mdp`=:pass");
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

        } catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function logout() : void {
        $_SESSION['loggedIn'] = "false";
        $_SESSION['role'] = 'GUEST';
        $_SESSION["uuid"] = -1;
        header("Location: ./login.php");
    }

}