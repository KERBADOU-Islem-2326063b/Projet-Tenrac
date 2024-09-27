<?php

namespace Blog\Controllers;

use Blog\Views\Layout;

class Members {

    /**
     * Affiche la page des membres
     * @return void
     */
    public function show(): void {
        $title = "Membres";
        $description = "Site officiel des Tenrac";
        $cssFilePath = '_assets/styles/members.css';
        $jsFilePath = '';

        $view = new \Blog\Views\Members();

        $layout = new Layout();
        $layout->renderTop($title, $description, $cssFilePath, $jsFilePath);
        $view->showView();
        $layout->renderBottom();
    }
}