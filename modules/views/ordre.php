<?php
namespace Blog\Views;

/**
 * Vue de la page de connexion
 */
class Ordre {
    private $ordre;
    private $currentPage;
    private $totalPages;


    public function __construct($ordre, $currentPage, $totalPages) {
        $this->ordre = $ordre;
        $this->currentPage = $currentPage;
        $this->totalPages = $totalPages;
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
                                <form method="POST" action="/ordre">
                                    <input type="hidden" name="nom" value="<?php echo htmlspecialchars($ordre1['nom_club']); ?>">
                                    <button type="submit" name="delete" class="btn-supprimer">Supprimer</button>
                                </form>

                                <form class="modif" method="POST" action="/ordre">
                                    <button type="submit" name="update" class="btn-modifier">Modifier</button>
                                    <div>
                                        <input type="hidden" name="oldNom" value="<?php echo htmlspecialchars($ordre1['nom_club']); ?>">
                                        <input type="text" name="newNom" value="<?php echo htmlspecialchars($ordre1['nom_club']); ?>" required>
                                        <input type="text" name="adresse" value="<?php echo htmlspecialchars($ordre1['adresse_postale']); ?>" required>
                                    </div>

                                </form>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
                <?php if ($_SESSION['id_tenrac']) { ?>
                    <tr>
                        <form method="POST" action="/ordre">
                            <td> <input type="text" name="nom" placeholder="Nom du club" style="width: 95%;" required> </td>
                            <td> <input type="text" name="adresse" placeholder="Adresse du club" style="width: 95%;" required> </td>
                            <td> <button type="submit" name="add" class="btn-ajouter">Ajouter</button> </td>
                        </form>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

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