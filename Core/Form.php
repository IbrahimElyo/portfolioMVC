<?php

namespace App\Core;

class Form
{
    private $formElements;

    // Obtenir les éléments du formulaire
    public function getFormElements()
    {
        return $this->formElements;
    }

    // Ajouter des attributs HTML
    private function addAttributes(array $attributes): string
    {
        $att = "";
        foreach ($attributes as $attribute => $value) {
            $att .= "$attribute='$value' ";
        }
        return $att;
    }

    // Commencer le formulaire
    public function startForm(string $action = '#', string $method = "POST", array $attributes = []): self
    {
        $this->formElements = "<form action='$action' method='$method' ";
        $this->formElements .= isset($attributes) ? $this->addAttributes($attributes) . ">" : ">";
        return $this;
    }

    // Ajouter un label
    public function addLabel(string $for, string $text, array $attributes = []): self
    {
        $this->formElements .= "<label for='$for' ";
        $this->formElements .= isset($attributes) ? $this->addAttributes($attributes) . ">" : ">";
        $this->formElements .= "$text</label>";
        return $this;
    }

    // Ajouter un champ input
    public function addInput(string $type, string $name, array $attributes = []): self
    {
        $this->formElements .= "<input type='$type' name='$name' ";
        $this->formElements .= isset($attributes) ? $this->addAttributes($attributes) . ">" : ">";
        return $this;
    }

    // Ajouter un champ textarea
    public function addTextarea(string $name, string $text = '', array $attributes = []): self
    {
        $this->formElements .= "<textarea name='$name' ";
        $this->formElements .= isset($attributes) ? $this->addAttributes($attributes) . ">" : ">";
        $this->formElements .= "$text</textarea>";
        return $this;
    }

    // Ajouter un champ select
    public function addSelect(string $name, array $options, array $attributes = []): self
    {
        $this->formElements .= "<select name='$name' ";
        $this->formElements .= isset($attributes) ? $this->addAttributes($attributes) . ">" : ">";
        foreach ($options as $key => $value) {
            $this->formElements .= "<option value='$key'>$value</option>";
        }
        $this->formElements .= "</select>";
        return $this;
    }

    // Terminer le formulaire
    public function endForm(): self
    {
        $this->formElements .= "</form>";
        return $this;
    }

    // Valider les données POST
    public static function validatePost(array $post, array $fields): bool
    {
        foreach ($fields as $field) {
            if (empty($post[$field]) || !isset($post[$field])) {
                return false;
            }
        }
        return true;
    }

    // Valider les fichiers uploadés
    public static function validateFiles(array $files, array $fields): bool
    {
        foreach ($fields as $field) {
            if (isset($files[$field]) && $files[$field]['error'] == 0) {
                return true;
            }
        }
        return false;
    }
}
