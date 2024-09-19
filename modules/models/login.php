<?php
namespace Blog\Models;
class Login {
    function login($pseudo, $motDePasse) {
        $users = array(
            'test' => 'test',
        );

        if (isset($users[$pseudo]) && $users[$pseudo] == $motDePasse) {
            $_SESSION['connected'] = true;
            $_SESSION['pseudo'] = $pseudo;
            return true;
        }
        return false;
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pseudo = $_POST['first'];
    $motDePasse = $_POST['password'];

    login($pseudo, $motDePasse);

    header('Location: ../views/login.php');
    exit;
}



?>