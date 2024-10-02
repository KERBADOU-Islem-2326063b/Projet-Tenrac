<?php
namespace Blog\Views;

/**
 * Vue de la page des members
 */
class Members {

    private $grades = [
    "AFFILIE" => "Affilié",
    "SYMPATHISANT" => "Sympathisant",
    "ADHERENT" => "Adhérent",
    "CHEVALIER" => "Chevalier",
    "DAME" => "Dame",
    "GRAND CHEVALIER" => "Grand Chevalier",
    "HAUTE DAME" => "Haute Dame",
    "COMMANDEUR" => "Commandeur",
    "GRAND CROIX" => "Grand’Croix"
    ];

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
                    <?php
                    // beaucoup de grades, on utilise une boucle pour rendre le code plus lisible
                    foreach ($this->grades as $value => $label) {
                        echo "<option value=\"$value\">$label</option>";
                    } ?>
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
    </form>

        <?php
        } // ajout d'un membre
        if(isset($_POST['addMember'])) {
            $error = $this->model->addNewMemberFromPost();

            if ($error !== true) { ?>
                <p class="error">Échec de la création du Tenrac <?=$_POST['id']?></p>
            <?php } else { ?>
                <p class="ok">Tenrac créé! Que le gras apporte joie et abondance à ce jeune poussin.</p>
            <?php }

            // modification d'un membre
        } else if(isset($_POST['modifMember'])) {
            $error = $this->model->modifMemberFromPost();

            if ($error !== true) { ?>
                <p class="error">Échec de la modification du Tenrac <?=$_POST['toModifId']?></p>
            <?php } else { ?>
                <p class="ok">Tenrac <?=$_POST['toModifId']?> modifié!</p>
            <?php }

            //suppression d'un membre
        } else if (isset($_POST['toDeleteId'])) {
            if($_POST['toDeleteId'] == $_SESSION['id_tenrac']) { // si on supprime le membre qui est connecté dans la session
                ?>
                <p class="error">Tu ne peux pas supprimer ton propre compte, bête tenrac.</p>
            <?php } else {   // on essaie de supprimer le membre et afficher le message de confirmation
                $error = $this->model->deleteMember($_POST['toDeleteId']);
                if ($error !== true) {  // si kapout alors on récupère l'erreur et on l'affiche
                   ?>
                    <p class="error"> Échec de la suppression de <?=$_POST['toDeleteId']?>, merci de contacter un administrateur (oops ^^)</p>
                <?php } else {  // sinon on affiche simplement le message de confirmation
                    ?>
                    <p class="ok"> <?=$_POST['toDeleteId']?> a été supprimé </p>

                <?php }
            }
        }
        ?>


    <p id="titre"><i>Membres</i></p>
    <?php

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
                <strong><?=$member["titre"]?></strong>
                <strong><?=$member["nom_"]?></strong>
            </div>
            <div class="colonneML">
                <strong><?=$member["courriel"]?></strong>
                <strong><?=$member["adresse_postale"]?></strong>
                <strong><?=$member["num_tel"]?></strong>
            </div>
            <div class="colonneR">
                <strong><?=$member["rang"]?> </strong>
                <strong><?=$member["grade"]?></strong>
                <strong><?=$member["dignite"]?></strong>
            </div>
        </div>
        <?php if ($_SESSION['id_tenrac'])
        { // Afficher un menu de modification en modal ?>
        <button class="toggleModif" onclick="openModal('<?=$member["id_tenrac"]?>')">Menu de modification</button>

        <div id="modifMenu-<?=$member["id_tenrac"]?>" class="modifMenu modal" style="display: none;">
                <form method="post">
                    <h2>Modifier <?=$member["id_tenrac"]?></h2>
                    <input type="hidden" name="toModifId" value="<?=$member["id_tenrac"]?>">
                    <div>
                        <label for="modif_courriel">Courriel:</label>
                        <input id="modif_courriel" type="text" name="modif_courriel" value="<?=$member["courriel"]?>">

                        <label for="modif_adresse_postale">Adresse postale:</label>
                        <input id="modif_adresse_postale" type="text" name="modif_adresse_postale" value="<?=$member["adresse_postale"]?>">

                        <label for="modif_num_tel">Téléphone:</label>
                        <input id="modif_num_tel" type="text" name="modif_num_tel" value="<?=$member["num_tel"]?>">

                        <label for="modif_titreTenrac">Titre :</label>
                        <select id="modif_titreTenrac" name="modif_titreTenrac" required>
                            <option value="PHILANTHROPE" <?php if ($member["titre"] == "PHILANTHROPE") echo "selected"; ?>>Philanthrope</option>
                            <option value="PROTECTEUR" <?php if ($member["titre"] == "PROTECTEUR") echo "selected"; ?>>Protecteur</option>
                            <option value="HONORABLE" <?php if ($member["titre"] == "HONORABLE") echo "selected"; ?>>Honorable</option>
                        </select>

                        <label for="modif_rang">Rang :</label>
                        <select id="modif_rang" name="modif_rang" required>
                            <option value="NOVICE" <?php if ($member["rang"] == "NOVICE") echo "selected"; ?>>Novice</option>
                            <option value="COMPAGNON" <?php if ($member["rang"] == "COMPAGNON") echo "selected"; ?>>Compagnon</option>
                        </select>

                        <label for="modif_grade">Grade :</label>
                        <select id="modif_grade" name="modif_grade" required>
                            <?php
                            // beaucoup de grades, on utilise donc une boucle pour rendre le code plus lisible encore une fois
                            foreach ($this->grades as $value => $label) {
                                $selected = ($member["grade"] == $value) ? "selected" : "";
                                echo "<option value=\"$value\" $selected>$label</option>";
                            } ?>
                        </select>

                        <label for="modif_dignite">Dignité :</label>
                        <select id="modif_dignite" name="modif_dignite">
                            <option value="MAITRE" <?php if ($member["dignite"] == "MAITRE") echo "selected"; ?>>Maître</option>
                            <option value="GRAND CHANCELIER" <?php if ($member["dignite"] == "GRAND CHANCELIER") echo "selected"; ?>>Grand Chancelier</option>
                            <option value="GRAND MAITRE" <?php if ($member["dignite"] == "GRAND MAITRE") echo "selected"; ?>>Grand Maître</option>
                        </select>

                    </div>
                    <div>
                        <button type="submit" name="modifMember" class="modalBtn">Enregistrer les modifications</button>
                        <button type="reset" class="modalBtn" onclick="closeModal('<?=$member["id_tenrac"]?>')">Fermer le menu</button>
                    </div>
                </form>

        </div>
    <?php } ?>
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