<?php
namespace Blog\Views;
class Repas {
    public function __construct(private readonly \Blog\Models\Repas $model) {    }

    public function showView() {
        ?>
            <main>
                <p id="titre"> Repas </p>
        <?php
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $totalPages = $this->model->getMaxPages();
            foreach($this->model->getRepas($page) as $row) {
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