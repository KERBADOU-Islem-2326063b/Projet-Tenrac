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
        $title = "Accueil";
        $description = "Site officiel des Tenrac";
        $cssFilePath = '_assets/styles/homepage.css';
        $jsFilePath = '';

        $view = new \Blog\Views\Homepage();

        $layout = new Layout($title, $description, $cssFilePath, $jsFilePath);
        $layout->renderTop();
        $view->showView();
        $layout->renderBottom();
    }
}