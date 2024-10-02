<?php
namespace Blog\Views;

/**
 * Vue de la page de connexion
 */
class Ordre {

    public function __construct(private $ordre, private $currentPage, private $totalPages, private $errorMessage= '') {
    }

    /**
     * Affichage de l'ordre des clubs Tenrac
     * @return void
     */
    public function showView(): void {
        ?>
        <main>
            <p class="ordre"><strong><i>L'Ordre des tenracs</i></strong></p>
            <table class="tableOrdre">
                <thead>
                <tr>
                    <td>Club</td>
                    <td>Adresse</td>
                    <?php if ($_SESSION['id_tenrac']) { ?>
                        <td>Actions</td>
                    <?php } ?>
                </tr>
                </thead>
                <tbody>

                <?php
                foreach ($this->ordre as $ordre1) {
                    ?>

                    <tr>
                        <td> <?php echo htmlspecialchars($ordre1['nom_club']); ?></td>
                        <td> <?php echo htmlspecialchars($ordre1['adresse_postale']); ?></td>
                        <?php if ($_SESSION['id_tenrac']) { ?>
                            <td>
                            <?php if ($ordre1['nom_club'] !== 'ORDRE DES TENRACS') { ?>
                                <form class="supp" method="POST" action="/ordre">
                                    <label for="oldNomU">
                                        <input id="oldNomU" type="hidden" name="nom" value="<?php echo htmlspecialchars($ordre1['nom_club']); ?>">
                                    </label>
                                    <button type="submit" name="delete" class="btn-supprimer">Supprimer</button>
                                </form>
                            <?php } ?>
                                <form class="modif" method="POST" action="/ordre">
                                    <button type="submit" name="update" class="btn-modifier">Modifier</button>
                                    <div>
                                        <label for="oldNomU">
                                            <input id="oldNom" type="hidden" name="oldNom" value="<?php echo htmlspecialchars($ordre1['nom_club']); ?>"/>
                                        </label>
                                        <label for="adresseU">
                                            <input id="adresseU" type="text" name="adresse" value="<?php echo htmlspecialchars($ordre1['adresse_postale']); ?>" required/>
                                        </label>
                                    </div>
                                </form>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
                <?php if ($_SESSION['id_tenrac']) { ?>
                    <tr>
                        <form method="POST" action="/ordre">
                            <td>
                                <label for="nomA">
                                    <input type="text" name="nom" placeholder="Nom du club" style="width: 95%;" required>
                                </label>
                            </td>
                            <td>
                                <label for="adresseA">
                                    <input id="adresseA" type="text" name="adresse" placeholder="Adresse du club" style="width: 95%;" required>
                                </label>
                            </td>
                            <td class="celluleAjout">
                                <button type="submit" name="add" class="btn-ajouter">Ajouter</button>
                            </td>
                        </form>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

            <?php if ($this->errorMessage): ?>
                <p class="error-message"><?php echo htmlspecialchars($this->errorMessage); ?></p>
            <?php endif; ?>

            <div class="pagination">
                <?php if ($this->currentPage > 1): ?>
                    <a href="/ordre?page=<?php echo $this->currentPage - 1; ?>">Précédent</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $this->totalPages; $i++): ?>
                    <a href="/ordre?page=<?php echo $i; ?>" class="<?php echo ($i === $this->currentPage) ? 'active' : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>

                <?php if ($this->currentPage < $this->totalPages): ?>
                    <a href="/ordre?page=<?php echo $this->currentPage + 1; ?>">Suivant</a>
                <?php endif; ?>
            </div>
        </main>
        <?php
    }
}
?>