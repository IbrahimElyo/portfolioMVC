<?php

namespace App\Core;

class CSRFToken
{
    private const SESSION_KEY = 'csrf_token';

    // Générer un token CSRF
    public static function generateToken(): void
    {
        if (!isset($_SESSION[self::SESSION_KEY])) {
            $_SESSION[self::SESSION_KEY] = bin2hex(openssl_random_pseudo_bytes(32)); // Créer un token aléatoire
        }
    }

    // Obtenir le token CSRF
    public static function getToken(): string
    {
        return $_SESSION[self::SESSION_KEY] ?? ''; // Retourner le token ou une chaîne vide
    }

    // Vérifier le token CSRF
    public static function verifyToken(string $token): bool
    {
        return isset($_SESSION[self::SESSION_KEY]) && $_SESSION[self::SESSION_KEY] === $token; // Vérifier si le token est valide
    }
}
