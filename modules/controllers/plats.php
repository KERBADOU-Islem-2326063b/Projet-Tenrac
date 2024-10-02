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
                    $model->addAliment($ingredient);
                    $model->linkPlatAliment($nom_plat, $ingredient);
                }
            } elseif(isset($_POST['update'])) {
                $nom_plat = $_POST['nom_plat'];

                $anciensIngredients = $_POST['oldNom_aliments'];

                $nouveauIngredients = $_POST['newNom_aliments'];

                for ($i = 0; $i < count($anciensIngredients); $i++) {
                    $model->updateIngredients($nom_plat, $anciensIngredients[$i], $nouveauIngredients[$i]);
                }
            } elseif(isset($_POST['addAlim'])) {
                $nom_plat = $_POST['nom_plat'];
                $nouvelIngredient = $_POST['newNom_aliment'];

                $model->addAliment($nouvelIngredient);
                $model->linkPlatAliment($nom_plat, $nouvelIngredient);
            } elseif(isset($_POST['deleteIngredient'])) {
                $nom_plat = $_POST['deleteFromPlat'];
                $nom_aliment = $_POST['deleteIngredient'];
                $model->removeComposePlat($nom_plat, $nom_aliment);
            }

        }

        $view = new \Blog\Views\Plats($model);

        $layout = new Layout();
        $layout->renderTop($title, $description, $cssFilePath, $jsFilePath);
        $view->showView();
        $layout->renderBottom();
    }
}