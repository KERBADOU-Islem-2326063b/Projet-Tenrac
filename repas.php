<?php
namespace Blog\View;
class Repas {

    public function showView() {
        ?>

<!DOCTYPE html>
    <html lang="fr">
        <style>
            <?php include './repas.css';?>
        </style>
        <body>
            <div id="repas">
                <p id="titre"> Repas </p>
                <div class="blocRepas">
                    <div class="colonneL">
                        <div> <strong> N° repas </strong> </div>
                        <div> Chevalier/Dame </div>
                    </div>
                    <div class="colonneML">
                        <div> Adresse complète </div>
                        <div> Code Postale </div>
                        <div> Departement </div>
                    </div>
                    <div class="colonneR">
                        <div> Plat </div>
                    </div>
                    <div class="colonneR">
                        <div> <strong> Date </strong> </div>
                    </div>
                </div>
            </div>
        </body>
    </html>
<?php
    }
}