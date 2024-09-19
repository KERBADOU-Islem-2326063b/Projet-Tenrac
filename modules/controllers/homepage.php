<?php
namespace Blog\Controllers;

class Homepage {
    public function show(): void {
        $title = "Page d'accueil";
        $description = "Site officel des Tenrac";

        $view = new \Blog\Views\Homepage();

        $layout = new \Blog\Views\Layout($title, $description);
        $layout->renderTop();
        $view->showView();
        $layout->renderBottom();
    }
}