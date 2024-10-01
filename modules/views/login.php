<?php
namespace Blog\Views;

/**
 * Vue de la page de connexion
 */
class Login {

    /**
     * @param string $errorMessage Message d'erreur pour l'affichage
     */
    public function __construct(private string $errorMessage) {
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
                    <input type="text" id="first" name="first" maxlength="50" placeholder="Entrez votre pseudo" required>

                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" maxlength="50" placeholder="Entrez votre mot de passe" required>

                    <div class="wrap">
                        <button type="submit" name="login" id="user">Se Connecter</button>
                    </div>
                </form>
            </div>
        </main>
        <?php
    }
}

/*
<div id="arch-down-left">
    <p id="plefttop">"Quand le croquant rencontre le fondant" <br> </p>
    <p id="prightbottom"> Savourer nos tenders croustillants recouverts d'une raclette fondante et parfumée... </p>
</div>
<div id="arch-down-right">
    <p id="prighttop"> "Le petit plus qui fait la différence" <br> </p>
    <p id="pleftbottom"> Dégustez nos tenracs accompagnés de nos sauces maison originales pour un voyage gustatif inoubliable... </p>
</div>
</body>
*/
?>