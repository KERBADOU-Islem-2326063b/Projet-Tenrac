<?php
namespace Blog\Views;

/**
 * Classe de la vue de la page de connexion
 */
class Login {
    private \Blog\Models\Login $model;

    /**
     * @param $model \Blog\Models\Login Modèle la page login s'occupant de la partie métier
     * @return void
     */
    public function __constructor(\Blog\Models\Login $model): void {
        $this->model = $model;
    }

    /**
     * Affichage du rendu de la page
     * @return void
     */
    function showView(): void {
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>HTML Login Form</title>
    <style>
        <?php include '_assets/styles/login.css';?>
    </style>
</head>
<body>
<div class="main">
    <h1>Tenrac</h1>
    <h3>Entrez vos informations de connexion</h3>
    <form action="" method="post">
        <label for="first">Pseudo</label>
        <input type="text" id="first" name="first" placeholder="Entrez votre pseudo" required>

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required>

        <div class="wrap">
            <button type="submit" name="action" id="user">Se Connecter</button>
        </div>
    </form>
</div>
</body>
</html>
<?php
    }
}
?>