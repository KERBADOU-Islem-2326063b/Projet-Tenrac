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
        $title = "Page d'accueil";
        $description = "Site officel des Tenrac";

        $view = new \Blog\Views\Homepage();

        $layout = new Layout($title, $description);
        $layout->renderTop();
        $view->showView();
        $layout->renderBottom();
    }
}