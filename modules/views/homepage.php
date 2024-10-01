<?php
namespace Blog\Views;

class Homepage {
    public function showView() {
        ?>
        <main>
            <h1>Bienvenue cher voyageur</h1>
            <p>Tenrac a pour but de réunir des adeptes de tenders de poulet à la raclette. Un tenrac est avant tout loyal à ces activités. Apprennez la vie, goûtez avec nous aux différentes recettes de poulet à la raclette.</p>
            <p>Sur ce site, vous pourrez rejoindre un <a href="/clubs">club</a> et voir leurs informations, voir la liste des <a href="/repas">repas</a> et plats ainsi que leurs ingrédiants, et plus encore !</p>
            <div class="carousel">
                <div class="carousel-container">
                    <div class="carousel-slide">
                        <img src="https://www.darty.com/darty-et-vous/sites/default/files/2022-07/raclette_2021_494.jpg" width="450" height="300" alt="Raclette">
                        <p>Une raclette, et du fromage fondu ...</p>
                    </div>
                    <div class="carousel-slide">
                        <img src="https://charcuterie-d-antan.fr/images/virtuemart/articles/tenders2.jpg" width="450" height="300" alt="Tenders">
                        <p>Un poulet bien croustillant</p>
                    </div>
                    <div class="carousel-slide">
                        <img src="https://www.darty.com/darty-et-vous/sites/default/files/2022-07/raclette_2021_494.jpg" width="450" height="100" alt="Raclette">
                        <p>Une raclette, et du fromage fondu ...</p>
                    </div>
                    <div class="carousel-slide">
                        <img src="https://charcuterie-d-antan.fr/images/virtuemart/articles/tenders2.jpg" width="450" height="300" alt="Tenders">
                        <p>Un poulet bien croustillant</p>
                    </div>
                </div>
            </div>
            <div class="carousel-controls">
                <button class="prev" id="prevBtn">&#10094;</button>
                <button class="next" id="nextBtn">&#10095;</button>
            </div>
            <p> Du fromage, et la meilleure viande au monde ... Qu'attendez vous,  <a href="/login">rejoingez nous !</a></p>
        </main>
        <?php
    }
}
