<?php

namespace App\Entities;

class Creation
{
    private $id_creation;
    private $title;
    private $description;
    private $created_at;
    private $picture;
    private $user_id;

    // Obtenir l'ID de la création
    public function getId()
    {
        return $this->id_creation;
    }

    // Obtenir le titre de la création
    public function getTitle()
    {
        return $this->title;
    }

    // Définir le titre de la création
    public function setTitle($title)
    {
        $this->title = $title;
    }

    // Obtenir la description de la création
    public function getDescription()
    {
        return $this->description;
    }

    // Définir la description de la création
    public function setDescription($description)
    {
        $this->description = $description;
    }

    // Obtenir la date de création
    public function getCreated_at()
    {
        return $this->created_at;
    }

    // Définir la date de création
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    }

    // Obtenir l'image de la création
    public function getPicture()
    {
        return $this->picture;
    }

    // Définir l'image de la création
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    // Obtenir l'ID de l'utilisateur
    public function getUserId()
    {
        return $this->user_id;
    }

    // Définir l'ID de l'utilisateur
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
}