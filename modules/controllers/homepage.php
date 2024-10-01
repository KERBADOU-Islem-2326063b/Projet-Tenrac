<?php
namespace Blog\Controllers;

use Blog\Views\Layout;

/**
 * Controlleur de la première page vitrine
 */
class Homepage {

    /**
     * Liaison entre la vue et le layout et affichage
     * Pas de liaison avec un contrôleur, la page étant statique
     */
    public function show(): void {

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
            $_SESSION['id_tenrac'] = '';
            header('Location: /homepage');
            exit();
        }

        $title = "Accueil";
        $description = "Site officiel des Tenrac";
        $cssFilePath = '_assets/styles/homepage.css';
        $jsFilePath = '_assets/javascript/homepage.js';

        $view = new \Blog\Views\Homepage();

        $layout = new Layout();
        $layout->renderTop($title, $description, $cssFilePath, $jsFilePath);
        $view->showView();
        $layout->renderBottom();
    }
}