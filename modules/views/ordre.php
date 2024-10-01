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
     * Affichage de l'ordre des clubs Tenrac
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
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>

                <?php
                foreach ($this->ordre as $ordre1) {
                ?>

                    <tr>
                        <td> <?php echo htmlspecialchars($ordre1['Nom_club']); ?></td>
                        <td> <?php echo htmlspecialchars($ordre1['adresse_postale']); ?></td>
                        <td>
                            <form method="POST" action="/ordre">
                                <input type="hidden" name="nom" value="<?php echo htmlspecialchars($ordre1['Nom_club']); ?>">
                                <button type="submit" name="delete" class="btn-supprimer">Supprimer</button>
                            </form>

                            <form class="modif" method="POST" action="/ordre">
                                <button type="submit" name="update" class="btn-modifier">Modifier</button>
                                <div>
                                    <input type="hidden" name="oldNom" value="<?php echo htmlspecialchars($ordre1['Nom_club']); ?>">
                                    <input type="text" name="newNom" value="<?php echo htmlspecialchars($ordre1['Nom_club']); ?>" required>
                                    <input type="text" name="adresse" value="<?php echo htmlspecialchars($ordre1['adresse_postale']); ?>" required>
                                </div>

                            </form>
                        </td>
                    </tr>
                <?php } ?>
                    <tr>
                        <form method="POST" action="/ordre">
                            <td> <input type="text" name="nom" placeholder="Nom du club" style="width: 95%;" required> </td>
                            <td> <input type="text" name="adresse" placeholder="Adresse du club" style="width: 95%;" required> </td>
                            <td> <button type="submit" name="add" class="btn-ajouter">Ajouter</button> </td>
                        </form>
                    </tr>
                </tbody>

            </table>

        </main>
        <?php
    }
}
?>