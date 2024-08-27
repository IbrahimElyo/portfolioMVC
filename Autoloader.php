<?php

namespace App;

class Autoloader {
    // Enregistrer l'autoloader
    static function register(){
        spl_autoload_register([
            __CLASS__, 'autoload'
        ]);
    }

    // Charger les classes automatiquement
    static function autoload($class){
        // Supprimer le namespace du début de la classe
        $class = str_replace(__NAMESPACE__."\\",'',$class);
        // Remplacer les backslashes par des slashes pour les chemins de fichier
        $class = str_replace('\\', '/', $class);
        // Vérifier si le fichier existe et l'inclure
        if(file_exists(__DIR__.'/'.$class.'.php')){
            require __DIR__ .'/'. $class .'.php';
        }
    }
}