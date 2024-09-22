<?php
namespace Blog\Views;

/**
 * Vue de la page de connexion
 */
class Login {
    private ?string $errorMessage;

    /**
     * @param string|null $errorMessage Message d'erreur pour l'affichage
     */
    public function __construct(?string $errorMessage = null) {
        $this->errorMessage = $errorMessage;
    }

    /**
     * Affichage du rendu de la page
     * @return void
     */
    public function showView(): void {
        ?>
        <main>
            <div class="loginForm">
                <h1>Tenrac</h1>
                <h3>Entrez vos informations de connexion</h3>
                <?php if ($this->errorMessage): ?>
                    <p style="color: red;"><?php echo $this->errorMessage; ?></p>
                <?php endif; ?>
                <form action="./login" method="post">
                    <label for="first">Pseudo</label>
                    <input type="text" id="first" name="first" maxlength="20" placeholder="Entrez votre pseudo" required>

                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" maxlength="20" placeholder="Entrez votre mot de passe" required>

                    <div class="wrap">
                        <button type="submit" name="login" id="user">Se Connecter</button>
                    </div>
                </form>
            </div>
        </main>
        <?php
    }
}
?>