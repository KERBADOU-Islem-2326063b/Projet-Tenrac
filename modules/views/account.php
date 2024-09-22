<?php
namespace Blog\Views;

/**
 * Vue de la première page
 */
class Account {
    /**
     * Rendu du contenu de la page d'informations du compte
     * @return void
     */

    private string $Nom;
    private string $courriel;
    private string $adresse_postal;
    private string $num_tel;
    private string $grade;
    private string $rang;
    private string $titre;
    private string $dignite;


    public function __construct(string $Nom, string $courriel, string $adresse_postal, string $num_tel, string $grade, string $rang, string $titre, string $dignite) {
        $this->Nom = $Nom;
        $this->courriel = $courriel;
        $this->adresse_postal = $adresse_postal;
        $this->num_tel = $num_tel;
        $this->grade = $grade;
        $this->rang  = $rang;
        $this->titre = $titre;
        $this->dignite = $dignite;
    }

    public function showView(): void {
        ?>
        <main>
            <div class="accountInformations">
                <h1><strong><?php echo 'Bonjour ' . $this->Nom?></strong></h1>
                <label><?php echo 'Courriel: ' . $this->courriel?></label>
                <label><?php echo 'Adresse Postal: ' . $this->adresse_postal?></label>
                <label><?php echo 'Numéro de Téléphone: ' . $this->num_tel?></label>
                <label><?php echo 'Grade: ' . $this->grade?></label>
                <label><?php echo 'Rang: ' . $this->rang?></label>
                <label><?php echo 'Titre: ' . $this->titre?></label>
                <label><?php echo 'Dignite: ' . $this->dignite?></label>

                <form action="./account" method="post">
                    <button type="submit" name="logout" id="user">Se Déconnecter</button>
                </form>
            </div>
        </main>
        <?php
    }
}
?>
