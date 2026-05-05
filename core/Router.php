<?php

class Router {
    private $routes = [];

    // Registra rutas GET
    public function get($uri, $action) {
        $this->routes['GET'][$uri] = $action;
    }

    public function resolve() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Detecta la ruta base (ej: /App/my-portfolio) y la elimina de la URI
        $basePath = str_replace('/public/index.php', '', $_SERVER['SCRIPT_NAME']);
        $uri = str_replace($basePath, '', $uri);

        // Normaliza la URI: si está vacía o es solo un slash, queda como '/'
        $uri = ($uri === '' || $uri === '/') ? '/' : $uri;

        // Verifica si la ruta existe
        if (!isset($this->routes[$method][$uri])) {
            http_response_code(404);
            echo "404 - Página no encontrada";
            return;
        }

        $action = $this->routes[$method][$uri];
        
        // Separa el nombre del controlador y el método (HomeController@index)
        list($controllerName, $methodName) = explode('@', $action);

        $controllerFile = __DIR__ . "/../app/Controllers/$controllerName.php";

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controller = new $controllerName();
            
            if (method_exists($controller, $methodName)) {
                $controller->$methodName();
            } else {
                echo "Error: El método $methodName no existe.";
            }
        } else {
            echo "Error: El controlador $controllerName no existe.";
        }
    }
}