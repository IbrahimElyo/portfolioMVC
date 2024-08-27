<?php

namespace App\Models;

use Exception;
use App\Core\DbConnect;
use App\Entities\Creation;

class CreationModel extends DbConnect
{
    // Trouver toutes les créations
    public function findAll()
    {
        $this->request = $this->connection->prepare("SELECT * FROM creation");
        $this->request->execute();
        return $this->request->fetchAll();
    }

    // Trouver les créations par ID utilisateur
    public function findByUserId($userId)
    {
        $this->request = $this->connection->prepare("SELECT * FROM creation WHERE user_id = :user_id");
        $this->request->bindParam(":user_id", $userId);
        $this->request->execute();
        return $this->request->fetchAll();
    }

    // Trouver une création par son ID
    public function find($id)
    {
        $this->request = $this->connection->prepare("SELECT * FROM creation WHERE id_creation = :id_creation");
        $this->request->bindParam(":id_creation", $id);
        $this->request->execute();
        return $this->request->fetch();
    }

    // Créer une nouvelle création
    public function create(Creation $creation)
    {
        $title = $creation->getTitle();
        $description = $creation->getDescription();
        $created_at = $creation->getCreated_at();
        $picture = $creation->getPicture();
        $user_id = $creation->getUserId();

        $this->request = $this->connection->prepare(
            "INSERT INTO creation (title, description, created_at, picture, user_id) 
            VALUES (:title, :description, :created_at, :picture, :user_id)"
        );
        $this->request->bindParam(":title", $title);
        $this->request->bindParam(":description", $description);
        $this->request->bindParam(":created_at", $created_at);
        $this->request->bindParam(":picture", $picture);
        $this->request->bindParam(":user_id", $user_id);
        $this->executeTryCatch(); // Exécuter la requête avec gestion des exceptions
    }

    // Mettre à jour une création
    public function update(int $id, Creation $creation)
    {
        $this->request = $this->connection->prepare("UPDATE creation
                                                     SET title = :title, description = :description, created_at = :created_at, picture = :picture
                                                     WHERE id_creation = :id_creation");

        $this->request->bindValue(":id_creation", $id);
        $this->request->bindValue(":title", $creation->getTitle());
        $this->request->bindValue(":description", $creation->getDescription());
        $this->request->bindValue(":created_at", $creation->getCreated_at());
        $this->request->bindValue(":picture", $creation->getPicture());
        $this->executeTryCatch(); // Exécuter la requête avec gestion des exceptions
    }

    // Supprimer une création
    public function delete($id)
    {
        $this->request = $this->connection->prepare("DELETE FROM creation WHERE id_creation = :id_creation");
        $this->request->bindParam(":id_creation", $id);
        $this->request->execute();
    }

    // Méthode pour exécuter une requête avec gestion des exceptions
    private function executeTryCatch()
    {
        try {
            $this->request->execute();
        } catch (Exception $e) {
            die('Erreur : ' .$e->getMessage());
        }
        $this->request->closeCursor();
    }
}
