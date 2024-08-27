<?php

namespace App\Models;

use App\Core\DbConnect;
use App\Entities\User;

class UserModel extends DbConnect
{
    protected $request;

    // Trouver un utilisateur par son ID
    public function find($id)
    {
        $this->request = $this->connection->prepare("SELECT * FROM users WHERE id = :id");
        $this->request->bindParam(":id", $id);
        $this->request->execute();
        $result = $this->request->fetch();

        if ($result) {
            $user = new User();
            $user->setUsername($result->username);
            $user->setPassword($result->password);
            $user->setRole($result->role);
            $user->setId($result->id);
            return $user;
        }
        return null;
    }

    // Trouver un utilisateur par son nom d'utilisateur
    public function findByUsername($username)
    {
        $this->request = $this->connection->prepare("SELECT * FROM users WHERE username = :username");
        $this->request->bindParam(":username", $username);
        $this->request->execute();
        $result = $this->request->fetch();

        if ($result) {
            $user = new User();
            $user->setUsername($result->username);
            $user->setPassword($result->password);
            $user->setRole($result->role);
            $user->setId($result->id);
            return $user;
        }
        return null;
    }

    // Créer un nouvel utilisateur
    public function create(User $user)
    {
        $username = $user->getUsername();
        $password = password_hash($user->getPassword(), PASSWORD_BCRYPT); // Hacher le mot de passe
        $role = $user->getRole();

        $this->request = $this->connection->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");
        $this->request->bindParam(":username", $username);
        $this->request->bindParam(":password", $password);
        $this->request->bindParam(":role", $role);
        $this->request->execute();
    }
}
