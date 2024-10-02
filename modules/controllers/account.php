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
     * @return void
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

        $db = Database::getInstance();
        $accountModel = new \Blog\Models\Account($db);

        $accountInfo = $accountModel->returnAll($_SESSION['id_tenrac']);

        $title = "Mon Compte";
        $description = "Page permettant de voir les informations du compte";
        $cssFilePath = '_assets/styles/account.css';
        $jsFilePath = '';

        $view = new \Blog\Views\Account($accountInfo['nom_'], $accountInfo['courriel'], $accountInfo['adresse_postale'], $accountInfo['num_tel'], $accountInfo['grade'], $accountInfo['rang'], $accountInfo['titre'], $accountInfo["dignite"]);

        $layout = new Layout();
        $layout->renderTop($title, $description, $cssFilePath, $jsFilePath);
        $view->showView();
        $layout->renderBottom();
    }
}