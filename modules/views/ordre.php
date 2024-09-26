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
            <table>
                <thead>
                <tr>
                    <td>Club</td>
                    <td>Adresse</td>
                </tr>
                </thead>
                <tbody>

                <?php
                foreach ($this->ordre as $ordre1) {
                ?>
                    <tr>
                        <?php
                        echo '<td>' . $ordre1['Nom_club'] . '</td>';
                        echo '<td>' . $ordre1['adresse_postale'] . '</td>';
                        ?>
                    </tr>
                    <?php
                }
                ?>


                </tbody>
            </table>
        </main>
        <?php
    }
}
?>