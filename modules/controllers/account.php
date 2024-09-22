<?php
namespace Blog\Controllers;

use Blog\Views\Layout;
use Database;

/**
 * Controlleur de la page dédié aux informations du compte courant
 */
class Account {

    /**
     * Liaison entre la vue et le layout et affichage
     * Récupération des informations du compte courant
     */
    public function show(): void {

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
            $_SESSION['id_tenrac'] = '';
            header('Location: /homepage');
            exit();
        }

        if (!$_SESSION['id_tenrac']) {
            header('Location: /login');
            exit();
        }

        $id_tenrac = $_SESSION['id_tenrac'];
        $db = new Database();
        $accountModel = new \Blog\Models\Account($db);

        $accountInfo = $accountModel->returnAll($id_tenrac);

        $title = "Mon Compte";
        $description = "Page permettant de voir les informations du compte";
        $cssFilePath = '_assets/styles/account.css';
        $jsFilePath = '';

        $view = new \Blog\Views\Account($accountInfo['Nom'], $accountInfo['courriel'], $accountInfo['adresse_postale'], $accountInfo['num_tel'], $accountInfo['grade'], $accountInfo['rang'], $accountInfo['titre'], $accountInfo["dignite"]);

        $layout = new Layout($title, $description, $cssFilePath, $jsFilePath);
        $layout->renderTop();
        $view->showView();
        $layout->renderBottom();
    }
}