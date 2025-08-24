<?php

class UserRepository
{
    public function createUser(string $email, string $pseudo, string $password) : bool
    {
        $sqlUser = "INSERT INTO users(email, pseudo) VALUES(?,?)";
        
        $connexion = Database::getInstance();

        if(isset($connexion))
        {
            $createUser = $connexion->prepare($sqlUser);

            if($createUser !== false)
            {
                $createUser->execute([$email,$pseudo]);
                return true;
            }
        }

        return false;

    }
}

?>