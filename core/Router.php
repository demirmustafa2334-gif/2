<?php
/**
 * URL Router
 */

class Router {
    private $routes = [];
    private $notFoundCallback;

    public function add($method, $path, $callback) {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'callback' => $callback
        ];
    }

    public function get($path, $callback) {
        $this->add('GET', $path, $callback);
    }

    public function post($path, $callback) {
        $this->add('POST', $path, $callback);
    }

    public function setNotFound($callback) {
        $this->notFoundCallback = $callback;
    }

    public function dispatch() {
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        
        // Remove query string
        $requestUri = strtok($requestUri, '?');
        
        // Remove trailing slash
        $requestUri = rtrim($requestUri, '/');
        if ($requestUri === '') {
            $requestUri = '/';
        }

        foreach ($this->routes as $route) {
            if ($route['method'] !== $requestMethod) {
                continue;
            }

            $pattern = $this->convertToRegex($route['path']);
            
            if (preg_match($pattern, $requestUri, $matches)) {
                array_shift($matches);
                return call_user_func_array($route['callback'], $matches);
            }
        }

        // 404 Not Found
        if ($this->notFoundCallback) {
            return call_user_func($this->notFoundCallback);
        }
        
        http_response_code(404);
        echo "404 - Page Not Found";
    }

    private function convertToRegex($path) {
        // Convert :param to regex
        $pattern = preg_replace('/\/:([^\/]+)/', '/([^/]+)', $path);
        return '#^' . $pattern . '$#';
    }
}
