<?php
namespace Blog\Views;

/**
 * Vue de la page des plats
 */
class Plats {
    private \Blog\Models\Plats $plat;

    public function __construct(\Blog\Models\Plats $plat) {
        $this->plat = $plat;
    }


    /**
     * Affichage du rendu de la page
     * @return void
     */
    public function showView(): void {
        ?>
        <body>
        <p id="titre"> Plats <br> </p>

        <div class="plats-container">
            <div class="rangee">
                <div class="plats">
                    <img class="imgplat"
                         src="C:\Users\Daphné\OneDrive\Images\image.png"
                         alt="image du plat n°1">

                    <p><b> <?php $this->plat->getPlats() ?> </b></p>

                    <p class="ingredient"> Ingrédients ingrédients ingrédient ingrédient ingrédient </p>

                </div>

                <div class="plats">
                    <img class="imgplat"
                         src="C:\Users\Daphné\OneDrive\Images\image.png"
                         alt="image du plat n°2">

                    <p><b> Plat 2 </b></p>

                    <p class="ingredient">Ingrédients ingrédients ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient</p>

                </div>

                <div class="plats">
                    <img class="imgplat"
                         src="C:\Users\Daphné\OneDrive\Images\image.png"
                         alt="image du plat n°3">

                    <p><b> Plat 3 </b></p>

                    <p class="ingredient">Ingrédients ingrédients ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient</p>

                </div>

                <div class="plats">
                    <img class="imgplat"
                         src="C:\Users\Daphné\OneDrive\Images\image.png"
                         alt="image du plat n°4">

                    <p><b> Plat 4 </b></p>

                    <p class="ingredient">Ingrédients ingrédients ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient</p>
                </div>
            </div>


            <div class="rangee">
                <div class="plats">
                    <img class="imgplat"
                         src="C:\Users\Daphné\OneDrive\Images\image.png"
                         alt="image du plat n°5">

                    <p><b> Plat 5 </b></p>

                    <p class="ingredient">Ingrédients ingrédients ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient</p>
                </div>

                <div class="plats">
                    <img class="imgplat"
                         src="C:\Users\Daphné\OneDrive\Images\image.png"
                         alt="image du plat n°6">

                    <p><b> Plat 6 </b></p>

                    <p class="ingredient">Ingrédients ingrédients ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient</p>
                </div>

                <div class="plats">
                    <img class="imgplat"
                         src="C:\Users\Daphné\OneDrive\Images\image.png"
                         alt="image du plat n°7">

                    <p><b> Plat 7</b></p>

                    <p class="ingredient">Ingrédients ingrédients ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient</p>
                </div>

                <div class="plats">
                    <img class="imgplat"
                         src="C:\Users\Daphné\OneDrive\Images\image.png"
                         alt="image du plat n°8">

                    <p><b> Plat 8 </b></p>

                    <p class="ingredient">Ingrédients ingrédients ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient ingrédient</p>
                </div>


            </div>

        </div>
        </body>
        <?php
    }
}
?>