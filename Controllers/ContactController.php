<?php

namespace App\Controllers;

use App\Core\Form;

class ContactController extends Controller
{
    public function displayForm()
    {
        // Crée le formulaire de connexion
        $form = new Form();
        $form->startForm('#', "POST")
        ->addLabel("name", "Votre nom", ["class" => "form-label"])
        ->addInput("text", "name", ["id" => "name", "class" => "form-control", "placeholder" => "Entrez votre nom"])
        
        ->addLabel("email", "Votre email", ["class" => "form-label"])
        ->addInput("email", "email", ["id" => "email", "class" => "form-control", "placeholder" => "Entrez votre email"])
        
        ->addLabel("subject", "Sujet", ["class" => "form-label"])
        ->addInput("text", "subject", ["id" => "subject", "class" => "form-control", "placeholder" => "Entrez le sujet de votre message"])
        
        ->addLabel("message", "Message", ["class" => "form-label"])
        ->addTextarea("message", "", ["id" => "message", "class" => "form-control", "rows" => 5, "placeholder" => "Entrez votre message"])
        
        ->addInput("submit", "send", ["value" => "Envoyer", "class" => "btn btn-primary mt-2"])
        ->endForm();

        $this->render('contact/displayForm', ['displayForm' => $form->getFormElements(), 'erreur' => $erreur ?? '']);
    }
}
