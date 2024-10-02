<?php
namespace Blog\Views;

class Homepage {
    public function showView() {
        ?>
        <main>
            <h1>Bienvenue chez les Tenrac !</h1>

            <div class="carousel">
                <div class="carousel-container">
                    <div class="carousel-slide">
                        <img src="https://www.darty.com/darty-et-vous/sites/default/files/2022-07/raclette_2021_494.jpg" width="450" height="300" alt="Raclette">
                        <p>Une raclette </p>
                    </div>
                    <div class="carousel-slide">
                        <img src="https://charcuterie-d-antan.fr/images/virtuemart/articles/tenders2.jpg" width="450" height="300" alt="Tenders">
                        <p>Un poulet bien croustillant</p>
                    </div>
                    <div class="carousel-slide">
                        <img src="https://www.darty.com/darty-et-vous/sites/default/files/2022-07/raclette_2021_494.jpg" width="450" height="100" alt="Raclette">
                        <p>Une raclette ...</p>
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

            <section class="about-section">
                <h2>À propos de Tenrac</h2>
                <p>Tenrac a pour but de réunir des adeptes de tenders de poulet à la raclette. Un tenrac est avant tout loyal à ces activités. Apprenez la vie, goûtez avec nous aux différentes recettes de poulet à la raclette.</p>
                <p>Sur ce site, vous pourrez rejoindre un <a href="/clubs">club</a> et voir leurs informations, voir la liste des <a href="/repas">repas</a> et plats ainsi que leurs ingrédients, et plus encore !</p>
                <p>Du fromage, et la meilleure viande au monde ... Qu'attendez-vous, <a href="/login">rejoignez-nous !</a></p>
            </section>

            <div class="testimonials">
                <h2>Ce que nos membres disent</h2>
                <div class="testimonial-bubble">
                    <p>"Le meilleur endroit pour déguster des tenders de poulet et de la raclette ensemble ! Une expérience unique, je suis fan."</p>
                    <p class="author">BERTRAND</p>
                </div>
                <div class="testimonial-bubble">
                    <p>"Je n'avais jamais pensé combiner ces deux ingrédients, et maintenant je ne peux plus m'en passer. Merci Tenrac !"</p>
                    <p class="author">DUPONT</p>
                </div>
                <div class="testimonial-bubble">
                    <p>"Un vrai régal pour les papilles ! Le club est super sympa et les recettes sont délicieuses."</p>
                    <p class="author">FONTAINE</p>
                </div>
            </div>
        </main>
        <?php
    }
}
