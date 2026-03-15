<?php
namespace App\Controllers;

use App\Models\Repository\UserRepository;
use Exception;

class UserController
{
    private UserRepository $userRepository;
    
    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function createUser()
    {

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $datas = [
                "name" => trim($_POST["name"]),
                "surname" => trim($_POST["surname"]),
                "email" => trim($_POST["email"]),
                "password" => $_POST["password"]
            ];

            if (!filter_var($datas['email'], FILTER_VALIDATE_EMAIL)) 
            {
                throw new Exception("Email not valide");
            }
            if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*\W).{8,}$/", $datas["password"])) 
            {
                throw new Exception("Error : password too weak");
            }
            if($this->userRepository->findUserByEmail($datas["email"]))
            {    
                throw new Exception("Error : Email already used");
            }
            else
            {  
                $hashedPassword = password_hash($datas["password"], PASSWORD_ARGON2ID);
                if($this->userRepository->createUser(
                    $datas["name"], 
                    $datas["surname"], 
                    $datas["email"], 
                    $hashedPassword
                ))
                {
                    $success = "User created with success !";
                }
                else 
                {   
                    throw new Exception("Error : Error during user creation");
                }
            }    
        }

        $this->render("createUser");
    }

    public function render(string $view)
    {
        if(!is_null($view))
        {
            return (require_once __DIR__ . "/../Views/". $view . ".php");
        }

        return null;
    }
}

?>  