<?php

require_once '_assets/includes/autoloader.php';
Autoloader::register();
/**
 * Classe du routeur du site
 */
class Router {
    private string $url;
    private array $routes = [];
    public function __construct($url) {
        $this->url = $url;
    }
    public function get($path, $callable): Route {
        $route = new Route($path, $callable);

        $this->routes["GET"][] = $route;
        return $route;
    }

    /**
     * Cherche la page correspondante au lien demandé
     * à partir de toutes les routes possibles
     * @return Route objet route correspondante à l'URI entrée
     * @throws RouterException si erreur il y a
     */
    public function run(): Route{
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

/**
 * Initialisation du routage des URI
 */
$router = new Router($_SERVER['REQUEST_URI']);
$router->get('/', function(){ (new \Blog\Controllers\Homepage())->show(); });
$router->get('/homepage', function(){ (new \Blog\Controllers\Homepage())->show();  });
$router->get('/bonjour', function(){ echo 'Bonjour'; });
$router->get('/connexion', function(){ (new \Blog\Controllers\Login())->show(); });
try {
    $router->run();
} catch (RouterException $e) {
    echo $e->getMessage();
    return;
}
?>