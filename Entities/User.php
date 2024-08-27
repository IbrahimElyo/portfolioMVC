<?php

namespace App\Entities;

class User
{
    private $id;
    private $username;
    private $password;
    private $role;

    // Convertir l'utilisateur en tableau
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'username' => $this->getUsername(),
            'password' => $this->getPassword(),
            'role' => $this->getRole(),
        ];
    }

    // Créer un utilisateur à partir d'un tableau
    public static function fromArray(array $data)
    {
        $user = new self();
        $user->setId($data['id']);
        $user->setUsername($data['username']);
        $user->setPassword($data['password']);
        $user->setRole($data['role']);
        return $user;
    }

    // Obtenir l'ID de l'utilisateur
    public function getId()
    {
        return $this->id;
    }

    // Définir l'ID de l'utilisateur
    public function setId($id)
    {
        $this->id = $id;
    }

    // Obtenir le nom d'utilisateur
    public function getUsername()
    {
        return $this->username;
    }

    // Définir le nom d'utilisateur
    public function setUsername($username)
    {
        $this->username = $username;
    }

    // Obtenir le mot de passe
    public function getPassword()
    {
        return $this->password;
    }

    // Définir le mot de passe
    public function setPassword($password)
    {
        $this->password = $password;
    }

    // Obtenir le rôle de l'utilisateur
    public function getRole()
    {
        return $this->role;
    }

    // Définir le rôle de l'utilisateur
    public function setRole($role)
    {
        if ($role !== 'admin' && $role !== 'user') {
            throw new \InvalidArgumentException('Invalid role'); // Valider le rôle
        }
        $this->role = $role;
    }
}