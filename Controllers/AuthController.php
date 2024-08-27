<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Entities\User;
use App\Core\SessionManager;
use App\Core\Form;

class AuthController extends Controller
{
    // Gère la connexion de l'utilisateur
    public function login()
    {
        SessionManager::startSession();
        if (Form::validatePost($_POST, ['username', 'password'])) {
            $userModel = new UserModel();
            $user = $userModel->findByUsername($_POST['username']);

            if ($user && password_verify($_POST['password'], $user->getPassword())) {
                $_SESSION['user'] = $user->toArray(); // Stocke les données utilisateur en tant que tableau
                SessionManager::regenerateId();
                header("Location: index.php?controller=creation&action=index");
                exit;
            } else {
                $erreur = "Nom d'utilisateur ou mot de passe incorrect";
            }
        }

        // Crée le formulaire de connexion
        $form = new Form();
        $form->startForm('#', "POST")
            ->addLabel("username", "Nom d'utilisateur", ["class" => "form-label"])
            ->addInput("text", "username", ["id" => "username", "class" => "form-control"])
            ->addLabel("password", "Mot de passe", ["class" => "form-label"])
            ->addInput("password", "password", ["id" => "password", "class" => "form-control"])
            ->addInput("submit", "login", ["value" => "Connexion", "class" => "btn btn-primary mt-2"])
            ->endForm();

        $this->render('auth/login', ['loginForm' => $form->getFormElements(), 'erreur' => $erreur ?? '']);
    }

    // Gère l'inscription de l'utilisateur
    public function register()
    {
        SessionManager::startSession();
        if (Form::validatePost($_POST, ['username', 'password', 'role'])) {
            $userModel = new UserModel();
            $user = new User();
            $user->setUsername($_POST['username']);
            $user->setPassword($_POST['password']);
            $user->setRole($_POST['role']);

            $userModel->create($user);
            header("Location: index.php?controller=auth&action=login");
            exit;
        }

        // Crée le formulaire d'inscription
        $form = new Form();
        $form->startForm('#', "POST")
            ->addLabel("username", "Nom d'utilisateur", ["class" => "form-label"])
            ->addInput("text", "username", ["id" => "username", "class" => "form-control"])
            ->addLabel("password", "Mot de passe", ["class" => "form-label"])
            ->addInput("password", "password", ["id" => "password", "class" => "form-control"])
            ->addLabel("role", "Rôle", ["class" => "form-label"])
            ->addSelect("role", ['user' => 'Utilisateur', 'admin' => 'Admin'], ["class" => "form-control"])
            ->addInput("submit", "register", ["value" => "Inscription", "class" => "btn btn-primary mt-2"])
            ->endForm();

        $this->render('auth/register', ['registerForm' => $form->getFormElements()]);
    }

    // Gère la déconnexion de l'utilisateur
    public function logout()
    {
        SessionManager::startSession();
        SessionManager::destroySession();
        header("Location: index.php?controller=auth&action=login");
        exit;
    }
}