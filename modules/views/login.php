<?php
namespace Blog\Views;

class Login {
    private $model;

    public function __constructor($model) {
        $this->model = $model;
    }

    function show() {
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>HTML Login Form</title>
    <style>
        <?php include '../../_assets/styles/login.css';?>
    </style>
</head>
<body>
<div class="main">
    <h1>Tenrac</h1>
    <h3>Entrez vos informations de connexion</h3>
    <form action="../models/login.php" method="post">
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