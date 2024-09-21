<?php

require_once '_assets/includes/Autoloader.php';
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

    public function post($path, $callable): Route {
        $route = new Route($path, $callable);
        $this->routes["POST"][] = $route;
        return $route;
    }
    /**
     * Cherche la page correspondante au lien demandé
     * à partir de toutes les routes possibles
     * @throws RouterException si erreur il y a
     */
    public function run(): void {
        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
            throw new RouterException("REQUEST_METHOD n'existe pas");
        }

        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route){
            if($route->match($this->url)){
                $route->call();
                return;
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
$router->get('/hello', function(){ echo 'Bonjour'; });
$router->get('/login', function() {
    $db = new Database();
    $loginModel = new \Blog\Models\Login($db);
    (new \Blog\Controllers\Login($loginModel))->show();
});

$router->post('/login', function() {
    $db = new Database();
    $loginModel = new \Blog\Models\Login($db);
    (new \Blog\Controllers\Login($loginModel))->show();
});

try {
    $router->run();
} catch (RouterException $e) {
    echo $e->getMessage();
    return;
}
?>