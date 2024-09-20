<?php
namespace Blog\Controllers;

use Blog\Views\Layout;
/**
 * Controlleur de la page de connexion
 */
class Login {

    /**
     * Liaison entre la vue et le layout et affichage
     * Pas de liaison avec un contrôleur, la page étant statique
     */
    public function show(): void {
        $title = "Page d'accueil";
        $description = "Site officel des Tenrac";

        $view = new \Blog\Views\Login();

        $layout = new Layout($title, $description);
        $layout->renderTop();
        $view->showView();
        $layout->renderBottom();
    }
}