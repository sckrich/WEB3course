<?php

class Router {
    private $routes = [];

    public function addRoute($method, $path, $callback) {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'callback' => $callback
        ];
    }

    public function resolve() {
        $requestedPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $requestedMethod = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if ($route['method'] === $requestedMethod && $route['path'] === $requestedPath) {
                return call_user_func($route['callback']);
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }

    public function get($path, $callback) {
        $this->addRoute('GET', $path, $callback);
    }

    public function post($path, $callback) {
        $this->addRoute('POST', $path, $callback);
    }
}
