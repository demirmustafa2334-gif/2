<?php
class Router {
    private $routes = [];
    
    public function addRoute($pattern, $handler) {
        $this->routes[$pattern] = $handler;
    }
    
    public function dispatch() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = trim($uri, '/');
        
        foreach ($this->routes as $pattern => $handler) {
            if ($this->matchRoute($pattern, $uri)) {
                $this->callHandler($handler, $this->getParams($pattern, $uri));
                return;
            }
        }
        
        // 404 Not Found
        http_response_code(404);
        include 'views/errors/404.php';
    }
    
    private function matchRoute($pattern, $uri) {
        if ($pattern === $uri) {
            return true;
        }
        
        // Convert pattern to regex
        $pattern = preg_replace('/\(([^)]+)\)/', '([^/]+)', $pattern);
        $pattern = str_replace('/', '\/', $pattern);
        $pattern = '/^' . $pattern . '$/';
        
        return preg_match($pattern, $uri);
    }
    
    private function getParams($pattern, $uri) {
        $params = [];
        $patternParts = explode('/', $pattern);
        $uriParts = explode('/', $uri);
        
        for ($i = 0; $i < count($patternParts); $i++) {
            if (isset($patternParts[$i]) && preg_match('/\([^)]+\)/', $patternParts[$i])) {
                $params[] = $uriParts[$i] ?? '';
            }
        }
        
        return $params;
    }
    
    private function callHandler($handler, $params = []) {
        list($controller, $method) = explode('@', $handler);
        
        $controllerFile = "controllers/{$controller}.php";
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controllerInstance = new $controller();
            
            if (method_exists($controllerInstance, $method)) {
                call_user_func_array([$controllerInstance, $method], $params);
            } else {
                throw new Exception("Method {$method} not found in {$controller}");
            }
        } else {
            throw new Exception("Controller {$controller} not found");
        }
    }
}
?>