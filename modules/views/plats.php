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

        <div class="container">
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

                    <?php
                    foreach ($ingredients as $ingredient): ?>
                    <p class="ingredient"> <?= htmlspecialchars($ingredient['nom_aliment']);?></p>
                    <?php endforeach;?>

                    <form class="modif" method="POST" action="/plats">
                        <div>
                            <input type="hidden" name="oldNom_plat" value="<?php echo htmlspecialchars($plat['nom_plat'])?>">
                            <input type="text" name="newNom_plat" value="<?php echo htmlspecialchars($plat['nom_plat'])?>" required>
                            <?php foreach ($ingredients as $ingredient): ?>
                            <div>
                                <input type="hidden" name="oldNom_aliment" value="<?php echo htmlspecialchars($ingredient['nom_aliment'])?>">
                                <input type="text" name="newNom_aliment" value="<?php echo htmlspecialchars($ingredient['nom_aliment']) ?>" required>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <button type="submit" name="update" class="btn-modifier">Modifier</button>
                    </form>

                    <?php
                    if(isset($_SESSION['id_tenrac'])): ?>
                        <form method="POST" action="/plats">
                            <input type="hidden" name="nom_plat" value="<?php echo htmlspecialchars($plat['nom_plat']); ?>" required>
                            <button type="submit" name="delete" class="btn-supprimer">Supprimer</button>
                        </form>
                    <?php endif; ?>
                </div>
                <?php endforeach;?>
            </div>
        </div>

        <div class="container-ajout">
            <?php
            if(isset($_SESSION['id_tenrac'])): ?>
                <form method="POST" action="/plats">
                    <input type="text" name="nom_plat" placeholder="Nom du plat" style="width: 95%;" required>
                    <input type="text" name="nom_aliment" placeholder="Nom d'un ingrédient (si plus, les séparer par ';')" style="width: 95%" required>
                    <button type="submit" name="add" class="btn-ajouter">Ajouter plat</button>
                </form>
            <?php endif; ?>
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
        </body>
<?php
    }
}?>