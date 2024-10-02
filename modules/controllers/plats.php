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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['delete'])) {
                $nom_plat = $_POST['nom_plat'];
                $model->removePlat($nom_plat);
            } elseif(isset($_POST['add'])) {
                $nom_plat = $_POST['nom_plat'];
                $tousLesIngredients = $_POST['nom_aliment'];

                $model->addPlat($nom_plat);
                $listeIngredients = explode(";", $tousLesIngredients);

                foreach ($listeIngredients as $ingredient) {
                    $error = $model->addIngredients($nom_plat, $ingredient);
                    if ($error !== true) {
                        echo $error;
                    }
                }
            } elseif(isset($_POST['modif'])) {
                $nom_plat = $_POST['nom_plat'];
                $model->updatePlat($nom_plat);

                $chaqueingredient = $_POST['nom_aliment'];
                foreach ($chaqueingredient as $ingredient) {
                    $model->updateIngredients($nom_plat, $ingredient);
                }
            }

        }


        $view = new \Blog\Views\Plats($model);

        $layout = new Layout($title, $description, $cssFilePath, $jsFilePath);
        $layout->renderTop();
        $view->showView();
        $layout->renderBottom();
    }
}