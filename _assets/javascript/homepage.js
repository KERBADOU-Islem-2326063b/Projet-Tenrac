/**
 *  On s'assure que le DOM est chargé, puis on s'occupe de la logique
 *  pour manipuler le carousel si un clique est détecte
 */
document.addEventListener('DOMContentLoaded', () => {
    const carouselContainer = document.querySelector('.carousel-container');
    const slides = document.querySelectorAll('.carousel-slide');
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    let currentIndex = 0;

    // Fonction pour montrer l'image correspondant à l'index actuel
    function showSlide(index) {
        if (index >= slides.length - 1) {
            currentIndex = 0;
        } else if (index < 0) {
            currentIndex = slides.length - 1;
        } else {
            currentIndex = index;
        }

        carouselContainer.style.transform = `translateX(${-currentIndex * 100}%)`;
    }

    // Listener pour les boutons
    nextBtn.addEventListener('click', () => showSlide(currentIndex + 1));
    prevBtn.addEventListener('click', () => showSlide(currentIndex - 1));

    // Slides automatiques
    setInterval(() => {
        showSlide(currentIndex + 1);
    }, 5000);
});