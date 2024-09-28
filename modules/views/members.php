<?php
namespace Blog\Views;

/**
 * Vue de la page des members
 */
class Members {
    public function __construct(private readonly \Blog\Models\Members $model) {    }

    /**
     * Affiche la page des membres
     * @return void
     */
    public function showView(): void
    {
?>
<main>
    <p id="titre"><i>Membres</i></p>
    <?php
    if (isset($_POST['toDeleteId'])) {
        if($_POST['toDeleteId'] == $_SESSION['id_tenrac']) { // si on supprime le membre qui est connecté dans la session
            ?>
            <p class="error">Tu ne peux pas supprimer ton propre compte, bête tenrac.</p>
        <?php } else {
         // on essaie de supprimer le membre et afficher le message de confirmation
            $error = $this->model->deleteMember($_POST['toDeleteId']);
            if ($error !== true) {
                // si kapout alors on récupère l'erreur et on l'affiche?>
                <p class="error"> Échec de la suppression de <?=$_POST['toDeleteId']?>, merci de contacter un administrateur (oops ^^)
                    <br> <?=$error?></p>
            <?php } else {
            // sinon on affiche simplement le message de confirmation ?>
                <p class="ok""> <?=$_POST['toDeleteId']?> a été supprimé </p>

    <?php }
        }
    }
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $totalPages = $this->model->getMaxPages();
    foreach ($this->model->getMembers($page) as $member):
        ?>
                <div class="bigName"><?=$member["id_tenrac"]?></div>
                <div class="membre">
                    <div class="colonneL">
                        <?php if ($_SESSION['id_tenrac']) { ?>
                                <form method="post">
                                    <input type="hidden" name="toDeleteId" value="<?=$member["id_tenrac"]?>">
                                    <button aria-label='supprimer membre' type='submit'>X</button>
                                </form>
                        <?php } ?>
                        <div><strong><?=$member["nom_"]?></strong></div>
                    </div>
                    <div class="colonneML">
                        <div><strong><?=$member["courriel"]?></strong></div>
                        <div><strong><?=$member["adresse_postale"]?></strong></div>
                        <div><strong><?=$member["num_tel"]?></strong></div>
                    </div>
                    <div class="colonneR">
                        <div><strong><?=$member["rang"]?> </strong></div>
                        <div><strong><?=$member["grade"]?></strong></div>
                        <div><strong><?=$member["dignite"]?></strong></div>
                    </div>
                </div>
        <?php endforeach; ?>

    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>" class="prev">Précédent</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <a href="?page=<?= $page + 1 ?>" class="next">Suivant</a>
        <?php endif; ?>
    </div>

</main>

<?php
    }
}