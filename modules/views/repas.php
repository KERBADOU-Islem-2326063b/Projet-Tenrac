<?php
namespace Blog\Views;
class Repas {
    public function __construct(private readonly \Blog\Models\Repas $model) {    }

    public function showView() {
        ?>
            <main>
                <p id="titre"> Repas </p>
        <?php
            if ($_SESSION['id_tenrac']) { ?>
                <p id="titre"><i>Formulaire divin d'ajout de repas</i></p>

                <form method="post">
                    <h2>Merci de remplir soigneusement les champs suivants</h2>
                    <div class="formInputs">
                        <div class="basicInfo">
                            <label for="date">Date et heure :</label>
                            <input type="text" id="date" name="date" required>

                            <label for="adresse">Adresse :</label>
                            <input type="text" id="adresse" name="adresse" required>
                        </div>
                        <button type="submit" name="addRepas">Ajouter le repas</button>
                    </div>
                </form>

            <?php
            }
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $totalPages = $this->model->getMaxPages();

            if (isset($_POST['toDeleteDate']) AND isset($_POST['toDeleteAdresse'])) {
                $error = $this->model->removeRepas($_POST['toDeleteDate'], $_POST['toDeleteAdresse']);
                if ($error !== true) {  // si kapout alors on récupère l'erreur et on l'affiche
                    ?>
                    <p class="error"> Échec de la suppression merci de contacter un administrateur (oops ^^)</p>
                <?php } else {  // sinon on affiche simplement le message de confirmation
                    ?>
                    <p class="ok"> <?=$_POST['toDeleteDate'], $_POST['toDeleteAdresse']?> a été supprimé </p>
                    <?php
                }
            }

        if (isset($_POST['addRepas'])) {
            $error = $this->model->addRepas($_POST['date'], $_POST['adresse']);
            if ($error !== true) {  // si kapout alors on récupère l'erreur et on l'affiche
                ?>
                <p class="error"> Échec de la suppression merci de contacter un administrateur (oops ^^)</p>
            <?php } else {  // sinon on affiche simplement le message de confirmation
                ?>
                <p class="ok"> <?=$_POST['date'], $_POST['adresse']?> a été supprimé </p>
                <?php
            }
        }

            foreach($this->model->getRepas($page) as $row) {
                if ($_SESSION['id_tenrac']) {
        ?>
        <form method="post">
            <input type="hidden" name="toDeleteDate" value="<?=$row["date_repas"]?>">
            <input type="hidden" name="toDeleteAdresse" value="<?=$row["adresse_postale"]?>">
            <button aria-label='supprimer repas' type='submit'>X</button>
        </form>
        <?php
                }
        ?>
        <div class="repas">
            <div class="colonneL">
                <div> <strong> Validation </strong> </div>
                <div>
                    <?php if ($row["est_valide"]) echo "Oui";
                    else echo "Non" ?>
                </div>
            </div>
        <div class="colonneML">
                <?php echo $row["adresse_postale"] ?>
            </div>
            <div class="colonneR">
                <?php foreach($this->model->getPlats($row["date_repas"], $row["adresse_postale"]) as $plat) {
                    echo "<div>" . $plat["nom_plat"] . "</div>";
                } ?>
            </div>
            <div class="colonneR">
                <div> <strong> <?php echo substr($row["date_repas"], 0, 10) ?> </strong> </div>
                <div> <strong> <?php echo substr($row["date_repas"], 11, 5) ?> </strong> </div>
            </div>
        </div>
    <?php
    }
        ?>
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
?>