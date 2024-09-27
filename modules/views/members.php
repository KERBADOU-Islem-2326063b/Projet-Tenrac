<?php
namespace Blog\Views;

/**
 * Vue de la page des members
 */
class Members {

    public function __construct() {

    }

    /**
     * Affiche la page des membres
     * @return void
     */
    public function showView(): void
    {
?>
<main>
    <p id="titre"> Repas </p>
    <div class="repas">
        <div class="colonneL">
            <div> <strong> N° repas </strong> </div>
            <div> Chevalier/Dame </div>
        </div>
        <div class="colonneML">
            <div> Adresse complète </div>
            <div> Code Postale </div>
            <div> Departement </div>
        </div>
        <div class="colonneR">
            Plat
        </div>
        <div class="colonneR">
            <strong> Date </strong>
        </div>
    </div>
</main>

<?php
    }
}