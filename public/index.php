<?php

use App\Autoloader;
use App\Core\Router;

// Inclure l'autoloader
include "../Autoloader.php";
Autoloader::register(); // Enregistrer l'autoloader

// Démarrer la session
session_start();

// Créer une instance du routeur
$route = new Router();
$route->routes(); // Définir les routes
