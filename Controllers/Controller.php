<?php

namespace App\Controllers;

abstract class Controller 
{
    public function render(string $path, array $data = [])
    {
        extract($data);

        // Démarrer le tampon de sortie
        ob_start();
        
        // Inclure le contenu spécifique de la page
        include dirname(__DIR__) . '/Views/' . $path . '.php';
        
        // Stocker le contenu dans une variable
        $content = ob_get_clean();

        // Inclure la structure de base de la page
        include dirname(__DIR__) . '/Views/base.php';
    }
}
