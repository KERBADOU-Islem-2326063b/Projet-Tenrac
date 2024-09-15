<?php

require_once '_assets/includes/autoloader.php';
Autoloader::register();
/**
 * Classe du routeur du site
 */
class Router {
    private $url;
    private $routes = [];
    public function __construct($url) {
        $this->url = $url;
    }
    public function get($path, $callable){
        $route = new Route($path, $callable);

        $this->routes["GET"][] = $route;
        return $route;
    }

    /**
     * Cherche la page correspondante au lien demandé
     * à partir de toutes les routes possibles
     * @throws RouterException si erreur il y a
     */
    public function run(){
        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
            throw new RouterException("REQUEST_mETHOD n'existe pas");
        }

        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route){
            if($route->match($this->url)){
                return $route->call();
            }
        }

        throw new RouterException('Pas de routes');
    }
}

$router = new Router($_SERVER['REQUEST_URI']);
$router->get('/', function(){ echo "BIENVENUE !!"; });
$router->get('/bonjour', function(){ echo "BONJOUR !!"; });
try {
    $router->run();
} catch (RouterException $e) {
    echo $e->getMessage();
}
?>

<?php

/*
<!DOCTYPE html>
<html lang="fr">
    <head>
        <style>
            <?php include '_assets/styles/index.css';?>
        </style>
        <script>
            <?php require_once("_assets/javascript/index.js");?>
        </script>
        <meta charset="UTF-8">
        <meta name="description" content="Tenrac, adeptes des tenders de poulet à la raclette">
        <meta name="keywords" content="Tenrac, tenders, poulet, raclette">
        <meta name="author" content="KERBADOU Islem, ODERZO Flavio, TRAN Thomas, ALVARES Titouan, AVIAS Daphné">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tenrac</title>
    </head>
    <body>
    <header>
        <div class="header-left">
            <div id="mySidenav" class="sidenav">
                <a id="closeBtn" href="#" class="close">×</a>
                <ul id = "menu">
                    <li><a href="#">REPAS</a></li>
                    <li><a href="#">PLATS</a></li>
                    <li><a href="#">CONNEXION</a></li>
                    <li><a href="#">L'ORDRE</a></li>
                </ul>
            </div>

            <a href="#" id="openBtn">
          <span class="burger-icon">
            <span></span>
            <span></span>
            <span></span>
          </span>
            </a>
            <img src="https://i.imgur.com/FR6znMh.png" width="200px" height="80%" class="logo">
            <ul class="menu">
                <li><a class="header-text" href="#">REPAS</a></li>
                <li><a class="header-text" href="#">PLATS</a></li>
                <li><a class="header-text" href="#">CONNEXION</a></li>
                <li><a class="header-text" href="#">L'ORDRE</a></li>
            </ul>
        </div>
        <div class = "header-right">
            <a href="#"><img src="https://i.imgur.com/Uw4eL5a.png" width="40px" height="38px" class="logo"></a>
        </div>


    </header>



    <main>
        <p>f</p>
        <p>f</p>
        <p>f</p>
        <p>f</p>
        <p>f</p>
        <p>f</p>
        <p>f</p>
        <p>f</p>
        <p>f</p>
        <p>f</p>
        <p>f</p>
        <p>f</p>
        <p>f</p>
        <p>f</p>
        <p>f</p>
        <p>f</p>
        <p>f</p>
        <p>f</p>
        <p>f</p>
        <p>f</p>
        <p>f</p>
        <p>f</p>
        <p>f</p>
        <p>f</p>
        <p>f</p>
        <p>f</p>
        <p>f</p>
        <p>f</p>
        <p>f</p>
    </main>





    <footer>
        <div class="apropos">
            <p><strong>Adresse :</strong> 105 rue de la raclette, 1934 Bagnes, Suisse. </p>
            <p><strong>Email :</strong> tenrac@poulet.fr</p>
            <p><strong>Téléphone :</strong> 06.12.34.56.78</p>
            <div>
                <a href="#"><img src="https://imgur.com/0kZm59H.png" width="30px" height="60%"></a>
                <a href="#"><img src="https://imgur.com/CTTXkU7.png" width="30px" height="60%"></a>
                <a href="#"><img src="https://imgur.com/QwF9yiJ.png" width="30px" height="60%"></a>
            </div>
        </div>


        <div>
            <p class="copyright">© Copyright 2024 Tenrac - All Rights Reserved.</p>
        </div>



    </footer>


    </body>
</html>
*/
?>