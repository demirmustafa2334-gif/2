<?php

class Router {
    private $routes = [];
    
    public function add($route, $controller, $action, $method = 'GET') {
        $this->routes[] = [
            'route' => $route,
            'controller' => $controller,
            'action' => $action,
            'method' => $method
        ];
    }
    
    public function dispatch($url) {
        $url = $url ?: '/';
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        
        foreach ($this->routes as $route) {
            $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[a-zA-Z0-9_-]+)', $route['route']);
            $pattern = '#^' . $pattern . '$#';
            
            if (preg_match($pattern, $url, $matches) && $_SERVER['REQUEST_METHOD'] === $route['method']) {
                $controllerName = $route['controller'];
                $actionName = $route['action'];
                
                $controllerFile = __DIR__ . '/controllers/' . $controllerName . '.php';
                
                if (file_exists($controllerFile)) {
                    require_once $controllerFile;
                    
                    if (class_exists($controllerName)) {
                        $controller = new $controllerName();
                        
                        if (method_exists($controller, $actionName)) {
                            // Remove numeric keys from matches
                            $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                            return call_user_func_array([$controller, $actionName], $params);
                        }
                    }
                }
            }
        }
        
        // 404 Not Found
        $this->notFound();
    }
    
    private function notFound() {
        http_response_code(404);
        require_once __DIR__ . '/views/frontend/404.php';
        exit;
    }
}
