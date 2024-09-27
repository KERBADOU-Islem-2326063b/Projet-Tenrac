<?php
namespace Blog\Views;

/**
 * Vue de la page dédiée aux informations du compte courant
 */
class Account {

    public function __construct(private string $Nom, private string $courriel, private string $adresse_postal, private string $num_tel, private string $grade, private string $rang, private string $titre, private string $dignite) {
    }

    /**
     * Rendu du contenu de la page d'informations du compte
     * @return void
     */
    public function showView(): void {
        ?>
        <main>
            <div class="accountInfo">
                <h1><strong><?php echo 'Bonjour ' . $this->Nom?></strong></h1>
                <p><?php echo '<strong>Courriel:</strong> ' . $this->courriel?></p>
                <p><?php echo '<strong>Adresse Postal:</strong> ' . $this->adresse_postal?></p>
                <p><?php echo '<strong>Numéro de Téléphone:</strong> ' . $this->num_tel?></p>
                <p><?php echo '<strong>Grade:</strong> ' . $this->grade?></p>
                <p><?php echo '<strong>Rang:</strong> ' . $this->rang?></p>
                <p><?php echo '<strong>Titre:</strong> ' . $this->titre?></p>
                <p><?php echo '<strong>Dignite:</strong> ' . $this->dignite?></p>

                <form action="./account" method="post">
                    <button type="submit" name="logout" id="user">Se Déconnecter</button>
                </form>
            </div>
        </main>
        <?php
    }
}
?>
