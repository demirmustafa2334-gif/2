<?php
declare(strict_types=1);

namespace App\Core;

final class Router
{
    /** @var array<string, array<int, array{pattern:string,regex:string,handler:mixed}>> */
    private array $routes = [];

    /** @var array<string, mixed> */
    private array $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    public function get(string $pattern, $handler): void
    {
        $this->add('GET', $pattern, $handler);
    }

    public function post(string $pattern, $handler): void
    {
        $this->add('POST', $pattern, $handler);
    }

    public function any(string $pattern, $handler): void
    {
        $this->add('GET', $pattern, $handler);
        $this->add('POST', $pattern, $handler);
    }

    private function add(string $method, string $pattern, $handler): void
    {
        $this->routes[$method] ??= [];
        $regex = $this->compilePattern($pattern);
        $this->routes[$method][] = [
            'pattern' => $pattern,
            'regex' => $regex,
            'handler' => $handler,
        ];
    }

    private function compilePattern(string $pattern): string
    {
        $escaped = preg_replace('#\/#', '\\/', $pattern);
        $regex = preg_replace('#\{([a-zA-Z_][a-zA-Z0-9_]*)\}#', '(?P<$1>[^\/]+)', $escaped);
        return '#^' . $regex . '$#u';
    }

    public function dispatch(Request $request): void
    {
        $method = $request->getMethod();
        $path = rtrim($request->getPath(), '/') ?: '/';

        $candidates = $this->routes[$method] ?? [];
        foreach ($candidates as $route) {
            if (preg_match($route['regex'], $path, $matches)) {
                $params = [];
                foreach ($matches as $key => $value) {
                    if (!is_int($key)) {
                        $params[$key] = $value;
                    }
                }
                $this->invoke($route['handler'], $request, $params);
                return;
            }
        }

        // 404
        http_response_code(404);
        echo '<h1>404 Not Found</h1>';
    }

    private function invoke($handler, Request $request, array $params): void
    {
        if (is_callable($handler)) {
            echo (string) call_user_func($handler, $request, $params);
            return;
        }

        if (is_string($handler)) {
            // Format: Controller@method or Admin\\Controller@method
            if (strpos($handler, '@') !== false) {
                [$controller, $method] = explode('@', $handler, 2);
            } else {
                $controller = $handler;
                $method = 'index';
            }

            $fqcn = 'App\\Controllers\\' . $controller;
            if (!class_exists($fqcn)) {
                throw new \RuntimeException("Controller '$fqcn' not found");
            }
            $instance = new $fqcn($this->config);
            if (!method_exists($instance, $method)) {
                throw new \RuntimeException("Method '$method' not found in controller '$fqcn'");
            }
            echo (string) $instance->$method($request, $params);
            return;
        }

        if (is_array($handler) && count($handler) === 2) {
            [$class, $method] = $handler;
            if (is_string($class)) {
                $fqcn = $class;
                if (!class_exists($fqcn)) {
                    throw new \RuntimeException("Controller '$fqcn' not found");
                }
                $instance = new $fqcn($this->config);
            } else {
                $instance = $class;
            }
            if (!method_exists($instance, $method)) {
                throw new \RuntimeException("Method '$method' not found in controller");
            }
            echo (string) $instance->$method($request, $params);
            return;
        }

        throw new \InvalidArgumentException('Invalid route handler');
    }
}
