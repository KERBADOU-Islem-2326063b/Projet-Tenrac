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
        <?php if ($_SESSION['id_tenrac']) { ?>
    <p id="titre"><i>Formulaire divin d'ajout de Tenrac</i></p>

    <form method="post">
        <h2>Merci de remplir soigneusement les champs suivants</h2>
        <div class="formInputs">
            <div class="basicInfo">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required>

                <label for="id">Identifiant Tenrac :</label>
                <input type="text" id="id" name="id" required>

                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>

                <label for="courriel">Courriel :</label>
                <input type="email" id="courriel" name="courriel" required>
            </div>
            <div>
                <label for="adresse_postale">Adresse postale :</label>
                <input type="text" id="adresse_postale" name="adresse_postale" required>

                <label for="num_tel">Téléphone :</label>
                <input type="tel" id="num_tel" name="num_tel" required>
            </div>
            <div>
                <label for="titreTenrac">Titre :</label>
                <select name="titreTenrac" id="titreTenrac" required>
                    <option value="PHILANTHROPE">Philanthrope</option>
                    <option value="PROTECTEUR">Protecteur</option>
                    <option value="HONORABLE">Honorable</option>
                </select>

                <label for="rang">Rang :</label>
                <select name="rang" id="rang" required>
                    <option value="NOVICE">Novice</option>
                    <option value="COMPAGNON">Compagnon</option>
                </select>

                <label for="grade">Grade :</label>
                <select name="grade" id="grade" required>
                    <option value="AFFILIE">Affilié</option>
                    <option value="SYMPATHISANT">Sympathisant</option>
                    <option value="ADHERENT">Adhérent</option>
                    <option value="CHEVALIER">Chevalier</option>
                    <option value="DAME">Dame</option>
                    <option value="GRAND CHEVALIER">Grand Chevalier</option>
                    <option value="HAUTE DAME">Haute Dame</option>
                    <option value="COMMANDEUR">Commandeur</option>
                    <option value="GRAND CROIX">Grand’Croix</option>
                </select>

                <label for="dignite">Dignité :</label>
                <select name="dignite" id="dignite" required>
                    <option value="MAITRE">Maître</option>
                    <option value="GRAND CHANCELIER">Grand Chancelier</option>
                    <option value="GRAND MAITRE">Grand Maître</option>
                </select>
            </div>
            <button type="submit" name="addMember">Ajouter le membre</button>
        </div>

        <?php
        }
        if(isset($_POST['addMember'])) {
            $error = $this->model->addNewMemberFromPost();

            if ($error !== true) { ?>
                <p class="error">Échec de la création du Tenrac <?=$_POST['id']?>
                    <br> <?=$error?></p>
            <?php } else { ?>
                <p class="ok">Tenrac créé! Que le gras apporte joie et abondance à ce jeune poussin.</p>
            <?php }
        }
        ?>

    </form>
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
                                <form method="post" class="deleteButtonForm">
                                    <input type="hidden" name="toDeleteId" value="<?=$member["id_tenrac"]?>">
                                    <button aria-label='supprimer membre' type='submit'>X</button>
                                </form>
                        <?php } ?>
                        <div><strong><?=$member["titre"]?></strong></div>
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