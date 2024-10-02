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
        $jsFilePath = '_assets/javascript/members.js';

        $model = new \Blog\Models\Members(\Database::getInstance());

        $view = new \Blog\Views\Members($model);

        $layout = new Layout();
        $layout->renderTop($title, $description, $cssFilePath, $jsFilePath);
        $view->showView();
        $layout->renderBottom();
    }
}