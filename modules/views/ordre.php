<?php
/**
namespace app\modules\views\ordre;

class Ordre {
    public function showview(): void {
**/

require '../../_assets/includes/layout.php'
?>

<?php
start_page('Ordre', 'Bienvenue dans la page de l\'ordre des tenracs');
?>
<style>
    <?php include '../../_assets/styles/ordre.css';?>
</style>
<main>
    <p class="ordre"><strong><i>L'Ordre des tenracs</i></strong></p>

    <table>
        <thead>
        <tr>
            <td>N° Club</td>
            <td>Club</td>
            <td>Nom du président</td>
            <td>Ville du club</td>
            <td>Adresse postale</td>
        </tr>
        </thead>
        <tbody>

        <?php
            $dbOrdre = mysqli_connect()#dbHost, dbLogin, dbPass
            or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

            mysqli_select_db($dbOrdre )#database
            or die('Erreur dans la sélection de la base : ' . mysqli_error($dbOrdre));

            $ordreQuery = 'SELECT * FROM club'; #à changer

            if(!($dbResult = mysqli_query($dbOrdre, $ordreQuery)))
            { echo 'Erreur de requête<br>';
                echo 'Erreur : ' . mysqli_error($dbOrdre) . '<br>';
                echo 'Requête : ' . $ordreQuery . '<br>';
                exit();
            }

            while($row = mysqli_fetch_assoc($dbResult)) {
            ?>

            <tr>
                <td><?php echo $row['Id']?></td>
                <td><?php echo $row['Club']?></td>
                <td><?php echo $row['Nom president']?></td>
                <td><?php echo $row['Ville']?></td>
                <td><?php echo $row['Adresse postale']?></td>

            </tr>

            <?php
                }
            ?>

        </tbody>
    </table>
</main>

<?php
    end_page();


?>


