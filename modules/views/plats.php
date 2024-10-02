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

        <main>
        <p id="titre"> Plats <br> </p>

        <div class="container">
            <div class="rangee">

                <?php
                $totalPages = $this->model->getMaxPages();
                foreach ($plats as $plat):
                    $noWspsPlat = str_replace(' ', '', $plat['nom_plat']);
                    $ingredients = $this->model->getIngredients($plat['nom_plat']);
                ?>

                <div class="plats">

                    <img class="imgplat"
                         src="https://imgur.com/chqWu1N.png"
                         alt="image du plat <?=htmlspecialchars($plat['nom_plat']); ?> ">

                    <p><b> <?= htmlspecialchars($plat['nom_plat']); ?> </b></p>

                    <?php
                    foreach ($ingredients as $ingredient): ?>
                    <div class="ingredientDiv">
                        <form method="post" class="deleteButtonForm">
                            <input type="hidden" name="deleteFromPlat" value="<?=$plat["nom_plat"]?>">
                            <input type="hidden" name="deleteIngredient" value="<?=$ingredient["nom_aliment"]?>">
                            <button class="deleteIngrButton" aria-label='supprimer membre' type='submit'>X</button>
                        </form>
                        <p class="ingredient"> <?= htmlspecialchars($ingredient['nom_aliment']);?></p>
                        <?php if(isset($_SESSION["id_tenrac"]) && $this->model->isAllergic($ingredient['nom_aliment'])) { ?>
                        <strong>!! Alerte Allergie !!</strong>
                            <?php } ?>
                        </div>
                     <?php endforeach;?>
                    <hr>
                    <?php
                    if(isset($_SESSION['id_tenrac'])): ?>
                        <form class="modif" method="POST" action="/plats">
                                <?php foreach ($ingredients as $ingredient):
                                    $noWSpsIngre = str_replace(' ', '', $ingredient['nom_aliment'])?>
                                    <div>
                                        <input type="hidden" name="nom_plat" value="<?=$plat['nom_plat']?>">
                                        <input type="hidden" name="oldNom_aliments[]" value="<?php echo htmlspecialchars($ingredient['nom_aliment'])?>">
                                        <label for="<?=$noWspsPlat . '-' . $noWSpsIngre?>"><i>Changer <?= $ingredient['nom_aliment'] ?> :</i></label>
                                        <input type="text" id="<?= $noWspsPlat . '-' . $noWSpsIngre?>" name="newNom_aliments[]" value="<?php echo htmlspecialchars($ingredient['nom_aliment']) ?>">
                                    </div>
                                <?php endforeach; ?>

                            <button type="submit" name="update" class="btn-modifier">Modifier</button>
                        </form>
                        <hr>
                        <form class="modif" method="POST" action="/plats">
                            <div>
                                <label for="addNomAliment-<?=$noWspsPlat?>"><i>Ajouter un aliment :</i></label>
                                <input type="hidden" name="nom_plat" value="<?=$plat['nom_plat']?>">
                                <input type="text" id="addNomAliment-<?=$noWspsPlat?>" name="newNom_aliment" required>
                            </div>

                            <button type="submit" name="addAlim" class="btn-modifier">Ajouter l'aliment</button>
                        </form>
                        <hr>
                        <form method="POST" action="/plats">
                            <input type="hidden" name="nom_plat" value="<?php echo htmlspecialchars($plat['nom_plat']); ?>">
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
                    <label for="nom_plat">Nom du plat : </label>
                    <input type="text" id="nom_plat" name="nom_plat" style="width: 95%;" required>
                    <label for="nom_aliment">Ingrédient(s) : </label>
                    <input type="text" id="nom_aliment" name="nom_aliment" placeholder="si plusieurs, les séparer par ';'" style="width: 95%" required>
                    <button type="submit" name="add" class="btn-ajouter">Ajouter plat</button>
                </form>
            <?php endif; ?>
        </div>

        <div class="pagination">
            <?php if ($page>1): ?>
                <a href="?page=<?= $page-1 ?>" class="prev"> Précédent</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <a href="?page=<?= $page+1?>" class="next">Suivant</a>
            <?php endif; ?>
        </div>
        </main>
<?php
    }
}?>