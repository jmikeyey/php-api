<?php

// src/Core/Router.php
namespace App\Core;

class Router {
    private $routes = [];
    private $container = [];

    public function add($method, $path, $handler) {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler
        ];
    }

    public function setContainer(array $container) {
        $this->container = $container;
    }

    public function dispatch($method, $path) {
        // echo "Requested method: $method\n";
        // echo "Requested path: $path\n";

        foreach ($this->routes as $route) {
            $routePath = preg_replace_callback('/{([a-zA-Z0-9_\-]+)}/', function($matches) {
                return '(?<'.$matches[1].'>[a-zA-Z0-9_\-]+)';
            }, $route['path']);

            if ($route['method'] === $method && preg_match("#^{$routePath}$#", $path, $matches)) {
                list($class, $method) = explode('@', $route['handler']);
                $class = "App\\Controllers\\$class";

                // Instantiate the controller with dependencies if available
                if (isset($this->container[$class])) {
                    $controller = new $class($this->container[$class]);
                } else {
                    $controller = new $class();
                }

                // Pass matched parameters to the controller method
                $controller->params = $matches;

                return $controller->$method();
            }
        }
        http_response_code(404);
        echo json_encode(['error' => 'Not Found']);
    }
}
