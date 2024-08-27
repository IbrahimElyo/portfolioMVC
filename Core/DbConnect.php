<?php

namespace App\Core;

use PDO;
use Exception;

class DbConnect {
    protected $connection;
    protected $request;


    const SERVER = "localhost:8889";
    const USER = "root";
    const PASSWORD = "root";
    const BASE = "cefiidev1425";

    // Constructeur pour établir la connexion à la base de données
    public function __construct(){
        try{
            // Créer une nouvelle connexion PDO
            $this->connection = new PDO('mysql:host=' .self::SERVER. ';dbname=' .self::BASE, self::USER, self::PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Définir le mode d'erreur à Exception
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); // Définir le mode de fetch par défaut à objet
            $this->connection->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8"); // Initialiser les commandes MySQL
        } catch (Exception $e) {
            die('Erreur : ' .$e->getMessage()); // Gérer les exceptions en cas d'erreur de connexion
        }
    }
}
