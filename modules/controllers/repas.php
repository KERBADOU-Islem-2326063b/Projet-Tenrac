<?php
namespace Blog\Controllers;

use Blog\Views\Layout;
use Database;

class Repas {

    /**
     * Liaison entre la vue et le layout et affichage
     * @return void
     */
    public function show(): void {
        $title = "Repas";
        $description = "Page d'affichage des repas";
        $cssFilePath = "_assets/styles/repas.css";
        $jsFilePath = '';

        $db = new Database();
        $model = new \Blog\Models\Repas($db);

        $view = new \Blog\Views\Repas($model);

        $layout = new Layout();
        $layout->renderTop($title, $description, $cssFilePath, $jsFilePath);

        $view->showView();
        $layout->renderBottom();
    }
}