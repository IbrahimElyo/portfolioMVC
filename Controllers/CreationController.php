<?php

namespace App\Controllers;

use App\Core\CSRFToken;
use App\Core\Form;
use App\Entities\Creation;
use App\Models\CreationModel;
use App\Core\SessionManager;
use App\Entities\User;

class CreationController extends Controller
{
    // Affiche la liste des créations
    public function index()
    {
        SessionManager::startSession();
        $userArray = $_SESSION['user'] ?? null;

        if (!$userArray) {
            header("Location: index.php?controller=auth&action=login");
            exit;
        }

        $user = User::fromArray($userArray);

        $creations = new CreationModel();
        $list = $user->getRole() === 'admin' ? $creations->findAll() : $creations->findByUserId($user->getId());

        $this->render('creation/index', ['list' => $list]);
    }

    // Ajoute une nouvelle création
    public function add()
    {
        SessionManager::startSession();
        $userArray = $_SESSION['user'] ?? null;

        if (!$userArray) {
            header("Location: index.php?controller=auth&action=login");
            exit;
        }

        $user = User::fromArray($userArray);

        CSRFToken::generateToken();

        if (Form::validatePost($_POST, ['title', 'description', 'date']) && Form::validateFiles($_FILES, ['picture'])) {
            if (CSRFToken::verifyToken($_POST['csrf_token'])) {
                $file = $_FILES['picture'];
                $fileType = mime_content_type($file['tmp_name']);
                $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
                $maxFileSize = 10 * 1024 * 1024;

                if (in_array($fileType, $allowedTypes) && $file['size'] <= $maxFileSize) {
                    $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
                    $newFileName = uniqid('', true) . '.' . $fileExtension;
                    $filePath = "images/" . $newFileName;

                    move_uploaded_file($file['tmp_name'], $filePath);

                    $creation = new Creation();
                    $creation->setTitle($_POST['title']);
                    $creation->setDescription($_POST['description']);
                    $creation->setCreated_at($_POST['date']);
                    $creation->setPicture($filePath);
                    $creation->setUserId($user->getId());

                    $model = new CreationModel();
                    $model->create($creation);

                    // Régénérer le jeton après une utilisation réussie
                    CSRFToken::generateToken();

                    SessionManager::regenerateId();
                    header("Location: index.php?controller=creation&action=index");
                    exit;
                } else {
                    echo "Le fichier uploadé n'est pas autorisé ou dépasse la taille maximale autorisée.";
                }
            } else {
                echo "Jeton CSRF invalide";
            }
        } else {
            $erreur = !empty($_POST) ? "Le formulaire n'a pas été correctement rempli" : "";
        }

        $form = new Form();
        $form->startForm('#', "POST", ['enctype' => 'multipart/form-data'])
            ->addLabel("title", "Titre", ["class" => "form-label"])
            ->addInput("text", "title", ["id" => "title", "class" => "form-control", "placeholder" => "Ajouter un titre"])
            ->addLabel("description", "Description", ["class" => "form-label"])
            ->addTextarea("description", "description de la création", ["id" => "description", "class" => "form-control", "rows" => 15])
            ->addLabel("date", "Date de publication", ["class" => "form-label"])
            ->addInput("date", "date", ["id" => "date", "class" => "form-control"])
            ->addLabel("picture", "Image de la création", ["class" => "form-label"])
            ->addInput("file", "picture", ["id" => "picture", "class" => "form-control mb-2"])
            ->addInput('hidden', 'csrf_token', ['value' => CSRFToken::getToken()])
            ->addInput("submit", "add", ["value" => "Ajouter", "class" => "btn btn-primary"])
            ->endForm();

        $this->render('creation/add', ['addForm' => $form->getFormElements(), 'erreur' => $erreur ?? '']);
    }

    // Affiche une création spécifique
    public function showCreation($id)
    {
        $creations = new CreationModel();
        $creation = $creations->find($id['id']);

        $this->render('creation/showCreation', ['creation' => $creation]);
    }

    // Met à jour une création existante
    public function updateCreation($id)
    {
        if(Form::validatePost($_POST, ['title', 'description', 'date', 'hidden'])) {
            $creation = new Creation();
            $creation->setTitle($_POST['title']);
            $creation->setDescription($_POST['description']);
            $creation->setCreated_at($_POST['date']);

            if(Form::validateFiles($_FILES, ['picture'])) {
                move_uploaded_file($_FILES['picture']['tmp_name'], "images/" . $_FILES["picture"]["name"]);
                $picture = "images/" . $_FILES["picture"]["name"];
                $creation->setPicture($picture);
            } else {
                $creation->setPicture($_POST['hidden']);
            }

            $creations = new CreationModel();
            $creations->update($id['id'], $creation);

            header("Location:index.php?controller=creation&action=index");
        } else {
            $erreur = !empty($_POST) ? "Le formulaire n'a pas été correctement rempli" : "";
        }

        $creations = new CreationModel();
        $creation = $creations->find($id['id']);

        $form = new Form();
        $form->startForm("#", "POST", ["enctype" =>"multipart/form-data"]);
        $form->addLabel("title", "Titre", ["class" => "form-label"]);
        $form->addInput("text", "title", ["id" => "title", "class" => "form-control", "placeholder" => "Ajouter un titre", "value" => $creation->title]);
        $form->addLabel("description", "Description", ["class" => "form-label"]);
        $form->addTextarea("description", $creation->description, ["id" => "description", "class" => "form-control", "rows" => 15]);
        $form->addLabel("date", "Date de publication", ["class" => "form-label"]);
        $form->addInput("text", "date", ["id" => "date", "class" => "form-control", "value" => $creation->created_at, "readonly" => ""]);
        $form->addLabel("picture", "Image de la création", ["class" => "form-label"]);
        $form->addInput("file", "picture", ["id" => "picture", "class" => "form-control mb-2"]);
        $form->addInput("text", "hidden", ["id" => "hidden", "class" => "form-control", "value" => $creation->picture, "hidden" => ""]);
        $form->addInput("submit", "update", ["value" => "Modifier", "class" => "btn btn-primary"]);
        $form->endForm();

        $this->render('creation/updateCreation', [
            'updateForm' => $form->getFormElements(),
            "erreur" => $erreur,
            "picture" => $creation->picture
        ]);
    }

    // Supprime une création
    public function deleteCreation($id)
    {
        SessionManager::startSession();
        $userArray = $_SESSION['user'] ?? null;

        if (!$userArray) {
            header("Location: index.php?controller=auth&action=login");
            exit;
        }

        $user = User::fromArray($userArray);

        $creations = new CreationModel();
        $creation = $creations->find($id['id']);

        if ($creation === false) {
            echo json_encode(['success' => false, 'error' => 'Création non trouvée']);
            exit;
        }

        if ($user->getRole() === 'admin' || $creation->user_id == $user->getId()) {
            if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
                $creations->delete($id['id']);
                echo json_encode(['success' => true]);
                exit;
            }
        }

        echo json_encode(['success' => false, 'error' => 'Unauthorized']);
        exit;
    }
}
