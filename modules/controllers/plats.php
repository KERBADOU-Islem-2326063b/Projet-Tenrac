<?php
namespace Blog\Controllers;

use Blog\Views\Layout;
use Database;

class Plats {

    /**
     * Liaison entre la vue et le layout et affichage
     * @return void
     */
    public function show(): void {
        $title = "Plats";
        $description = "Page d'affichage des plats";
        $cssFilePath = '_assets/styles/plats.css';
        $jsFilePath = '';

        $db = new Database();
        $model = new \Blog\Models\Plats($db);

        $view = new \Blog\Views\Plats($model);

        $layout = new Layout($title, $description, $cssFilePath, $jsFilePath);
        $layout->renderTop();
        $view->showView();
        $layout->renderBottom();
    }
}