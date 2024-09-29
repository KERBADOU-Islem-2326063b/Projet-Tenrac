<?php
namespace Blog\Views;

class Homepage {
    public function showView() {
        ?>
        <main>
            <div class="carousel">
                <div class="carousel-container">
                    <div class="carousel-slide">
                        <img src="https://www.darty.com/darty-et-vous/sites/default/files/2022-07/raclette_2021_494.jpg" width="450" height="300" alt="Raclette miam">
                        <p>Une raclette, et du fromage fondu ...</p>
                    </div>
                    <div class="carousel-slide">
                        <img src="https://charcuterie-d-antan.fr/images/virtuemart/articles/tenders2.jpg" width="450" height="300" alt="Tenders miam 1">
                        <p>Un poulet bien croustillant</p>
                    </div>
                    <div class="carousel-slide">
                        <img src="https://www.darty.com/darty-et-vous/sites/default/files/2022-07/raclette_2021_494.jpg" width="450" height="100" alt="Image d'un signe egal">
                        <p>Du fromage bien fondu</p>
                    </div>
                    <div class="carousel-slide">
                        <img src="https://charcuterie-d-antan.fr/images/virtuemart/articles/tenders2.jpg" width="450" height="300" alt="Image 1">
                        <p>Un poulet bien croustillant</p>
                    </div>
                </div>
            </div>
            <div class="carousel-controls">
                <button class="prev" id="prevBtn">&#10094;</button>
                <button class="next" id="nextBtn">&#10095;</button>
            </div>
            <p>Un tenrac est avant tout loyal à ces activités. Apprennez la vie, goûtez avec nous aux différentes recettes de poulet à la raclette. Du fromage, et la meilleure viande au monde ...</p>
            <p>Qu'attendez vous, cliquez <a href="/login">ici</a> !</p>
        </main>
        <?php
    }
}
