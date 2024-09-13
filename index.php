<?php
use Includes\Route;
use Includes\Exceptions\RouterException;
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

$router = new Router($_GET['url']);
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
        <meta charset="UTF-8">
        <meta name="description" content="Tenrac, adeptes des tenders de poulet à la raclette">
        <meta name="keywords" content="Tenrac, tenders, poulet, raclette">
        <meta name="author" content="KERBADOU Islem, ODERZO Flavio, TRAN Thomas, ALVARES Titouan, Avias Daphne">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tenrac</title>
    </head>
    <body>
    <header>
        <img src="https://i.imgur.com/e1rxMEL.png" width="1em" height="1em">
        <img src="https://i.imgur.com/FR6znMh.png" width="2em" height="1em">
        <ul>
            <li><a href="#">REPAS</a></li>
            <li><a href="#">PLATS</a></li>
            <li><a href="#">AUTHENTIFICATION</a></li>
        </ul>
    </header>
    <main>Ouais le main</main>
    <footer>Les raclettes</footer>
    </body>
</html>
*/
?>