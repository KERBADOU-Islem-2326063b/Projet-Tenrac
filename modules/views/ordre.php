<?php
namespace Blog\Views;

/**
 * Vue de la page de connexion
 */
class Ordre {
    private $ordre;
    public function __construct($ordre) {
        $this->ordre = $ordre;
    }

    /**
     * Affichage de l'odre des clubs Tenrac
     * @return void
     */
    public function showView(): void {
        ?>
        <main>
            <p class="ordre"><strong><i>L'Ordre des tenracs</i></strong></p>
            <table id="tableOrdre">
                <thead>
                <tr>
                    <td>Club</td>
                    <td>Adresse</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>

                <?php
                foreach ($this->ordre as $ordre1) {
                ?>
                    <tr>
                        <td> <?php echo $ordre1['Nom_club'] ?></td>
                        <td> <?php echo $ordre1['adresse_postale'] ?></td>
                        <td> <input id="suppId" type="button" onclick="supprimer()"> <input type="button" value="Modifier" onclick="modifLigne()"></td>
                    </tr>
                    <?php
                }
                ?>
               <tr>
                   <td> <input id="text_id1" type="text" style="width: 95%;"> </td>
                   <td> <input id="text_id2" type="text" style="width: 95%;"> </td>
                   <td> <input type="button" value="Ajouter" onclick="ajouterLigne()"> </td>
               </tr>

                </tbody>
            </table>
            <?php
                if ($_SESSION['id_tenrac']) {
                }
            ?>
        </main>
        <?php
    }
}
?>