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
            <p id="titre"> Repas </p>
            <div class="repas">
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
                    Plat
                </div>
                <div class="colonneR">
                    <strong> Date </strong>
                </div>
            </div>
        </body>
    </html>
<?php
    }
}
/*    $dbLink = mysqli_connect('mysql-tenrac.alwaysdata.net', 'tenrac_db', 'JdozlVeieo628hK')
        or die('Erreur de connexion au serveur : ' . mysqli_connect_error());*/
?>