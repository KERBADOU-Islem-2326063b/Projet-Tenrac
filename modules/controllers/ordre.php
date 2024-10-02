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
     * @return void
     */
    public function show(): void {
        $title = "Clubs";
        $description = "Ordre des clubs des tenrac";
        $cssFilePath = '_assets/styles/ordre.css';
        $jsFilePath = '_assets/javascript/ordre.js';



        $db = new Database();
        $ordreModel = new \Blog\Models\Ordre($db);
        $errorMessage = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['add'])) {
                $nom = $_POST['nom'];
                $adresse = $_POST['adresse'];

                try {
                    $ordreModel->addOrdre($nom, $adresse);
                } catch (\Exception $e) {
                    $errorMessage = $e->getMessage();
                }

            } elseif (isset($_POST['update'])) {
                $oldNom = $_POST['oldNom'];
                $adresse = $_POST['adresse'];

                $ordreModel->updateOrdre($oldNom, $adresse);

            } elseif (isset($_POST['delete'])) {
                $nom = $_POST['nom'];

                $ordreModel->deleteOrdre($nom);
            }
        }


        $limit = 5;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $result = $ordreModel->returnAll($limit, $offset);

        $totalClubs = $ordreModel->countAll();
        $totalPages = ceil($totalClubs / $limit);


        $view = new \Blog\Views\Ordre($result, $page, $totalPages, $errorMessage);
        $layout = new Layout();
        $layout->renderTop($title, $description, $cssFilePath, $jsFilePath);
        $view->showView();
        $layout->renderBottom();
    }
}