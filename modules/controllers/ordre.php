<?php
namespace Blog\Controllers;

use Blog\Views\Layout;
use Database;

/**
 * Contrôleur de la page de l'ordre des Tenrac
 */
class Ordre {

    /**
     * Liaison entre la vue et le layout et affichage
     * Gestion de l'ordre des Ternac
     */
    public function show(): void {
        $title = "Clubs";
        $description = "Ordre des clubs des tenrac";
        $cssFilePath = '_assets/styles/ordre.css';
        $jsFilePath = '_assets/javascript/ordre.js';



        $db = new Database();
        $ordreModel = new \Blog\Models\OrdreModel($db);
        $result = $ordreModel->returnAll();


        $view = new \Blog\Views\Ordre($result);

        $layout = new Layout($title, $description, $cssFilePath, $jsFilePath);
        $layout->renderTop();
        $view->showView();
        $layout->renderBottom();
    }
}