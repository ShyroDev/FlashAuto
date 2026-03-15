<?php
namespace App\Models\Repository;

use App\Models\Database;
use App\Models\Entities\User;
use PDO;

class UserRepository
{
    public function createUser(string $name, string $surname,string $email, string $password) : bool
    {
        $sqlUser = "INSERT INTO users(name, surname,email, password) VALUES(?,?,?,?)";
        
        $connexion = Database::getInstance();

        if(isset($connexion))
        {
            $createUser = $connexion->prepare($sqlUser);

            if($createUser !== false)
            {
                $createUser->execute([$name, $surname, $email, $password]);
                return true;
            }
        }
        return false;
    }

    public function findUserByEmail(string $email) : ?User
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $connexion = Database::getInstance();

        if(isset($connexion))
        {
            $find = $connexion->prepare($sql);
            $find->execute([$email]);
            $datas = $find->fetch(PDO::FETCH_ASSOC);

            if(!$datas)
            {
                return null;
            }

            return new User(
                $datas["id"],
                $datas["name"],
                $datas["surname"],
                $datas["email"],
                $datas["password"],
            );
        }
        return null;
    }
}

?>