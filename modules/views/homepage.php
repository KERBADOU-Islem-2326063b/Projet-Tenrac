<?php
namespace Blog\Views;

/**
 * Vue de la première page
 */
class Homepage {
    /**
     * Rendu du contenu centrale de la première page
     * @return void
     */
    public function showView(): void {
        ?>
        <main>
            <h1>Ceci est un Test !</h1>
        </main>
        <?php
    }
}
?>