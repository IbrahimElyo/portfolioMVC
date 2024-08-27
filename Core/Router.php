<?php

namespace App\Core;

class Router
{
    // Méthode pour définir les routes
    public function routes()
    {
        // Déterminer le contrôleur
        $controller = (isset($_GET['controller']) ? ucfirst(array_shift($_GET)) : 'Home');
        $controller = '\\App\\Controllers\\'.$controller.'Controller';
        
        // Déterminer l'action
        $action = (isset($_GET['action']) ? array_shift($_GET) : 'index');
        
        // Instancier le contrôleur
        $controller = new $controller();

        // Vérifier si la méthode existe dans le contrôleur
        if(method_exists($controller, $action)) {
            // Appeler la méthode avec les paramètres GET
            (isset($_GET)) ? $controller->$action($_GET) : $controller->$action();
        } else {
            // Envoyer une réponse 404 si la méthode n'existe pas
            http_response_code(404);
            echo "La page recherchée n'existe pas";
        }
    }
}