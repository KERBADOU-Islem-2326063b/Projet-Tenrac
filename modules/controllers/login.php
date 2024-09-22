<?php
namespace Blog\Controllers;

use Blog\Views\Layout;
use Database;

/**
 * Contrôleur de la page de connexion
 */
class Login {

    /**
     * Liaison entre la vue et le layout et affichage
     * Gestion de la soumission du formulaire de connexion
     */
    public function show(): void {
        $title = "Connexion";
        $description = "Page de connexion des Tenrac";
        $cssFilePath = '_assets/styles/login.css';
        $jsFilePath = '';

        $errorMessage = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
            $usernameLogs = $_POST['first'] ?? '';
            $passwordLogs = $_POST['password'] ?? '';
            $db = new Database();
            $loginModel = new \Blog\Models\Login($db);

            if ($loginModel->doLogsExist($usernameLogs, $passwordLogs)) {
                $_SESSION['id_tenrac'] = $usernameLogs;
                header('Location: /homepage');
                exit();
            } else {
                $errorMessage = 'Pseudo ou mot de passe incorrect';
            }
        }

        $view = new \Blog\Views\Login($errorMessage);

        $layout = new Layout($title, $description, $cssFilePath, $jsFilePath);
        $layout->renderTop();
        $view->showView();
        $layout->renderBottom();
    }
}