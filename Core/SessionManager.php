<?php

namespace App\Core;

class SessionManager
{
    // Démarrer la session si elle n'est pas déjà démarrée
    public static function startSession()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Régénérer l'ID de session
    public static function regenerateId()
    {
        session_regenerate_id(true);
    }

    // Détruire la session
    public static function destroySession()
    {
        $_SESSION = []; // Vider le tableau $_SESSION
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            // Supprimer le cookie de session
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy(); // Détruire la session
    }

    // Vérifier si la session est active
    public static function isSessionActive(): bool
    {
        return session_status() === PHP_SESSION_ACTIVE;
    }
}
