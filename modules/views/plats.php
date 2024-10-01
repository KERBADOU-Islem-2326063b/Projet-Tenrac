<?php
namespace Blog\Views;

/**
 * Vue de la page des plats
 */
class Plats {
    private \Blog\Models\Plats $model;

    public function __construct(\Blog\Models\Plats $model) {
        $this->model = $model;
    }


    /**
     * Affichage du rendu de la page
     * @return void
     */
    public function showView(): void {

        $page = isset($_GET['page'])? (int)$_GET['page'] : 1;
        $plats = $this->model->getPlats($page);

        ?>

        <body>
        <p id="titre"> Plats <br> </p>

        <div class="plats-container">
            <div class="rangee">

                <?php
                $totalPages = $this->model->getMaxPages();
                foreach ($plats as $plat):
                    $ingredients = $this->model->getIngredients($plat['nom_plat']);
                    ?>
                <div class="plats">
                    <img class="imgplat"
                         src="https://imgur.com/chqWu1N.png"
                         alt="image du plat n° <?=htmlspecialchars($plat['nom_plat']); ?> ">

                    <p><b> <?= htmlspecialchars($plat['nom_plat']); ?> </b></p>

                    <?php foreach ($ingredients as $ingredient):
                    ?>
                    <p class="ingredient"> <?= htmlspecialchars($ingredient['nom_aliment']);?> </p>
                    <?php endforeach;?>
                </div>
                <?php endforeach;?>
            </div>

            <div class="pagination">
                <?php if ($page>1): ?>
                    <a href="?page=<?= $page-1 ?>" class="prev"> Précédent</a>
                <?php endif; ?>

                <?php for ($i=1; $i<=$totalPages; $i++): ?>
                    <a href="?page=<?= $i ?>" class="<? $i == $page ? 'active': '' ?>"><?= $i ?></a>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?= $page+1?>" class="next">Suivant</a>
                <?php endif; ?>
            </div>

        </div>

        </body>
<?php
    }
}?>