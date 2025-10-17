<?php
declare(strict_types=1);

namespace App\Core;

final class Router
{
    /** @var array<string, array<int, array{pattern:string, regex:string, params:array<int,string>, handler:callable|string|array}>> */
    private array $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'PATCH' => [],
        'DELETE' => [],
    ];

    /** @var array<string,mixed> */
    private array $config;

    /** @param array<string,mixed> $config */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /** @param callable|array|string $handler */
    public function get(string $pattern, $handler): void { $this->add('GET', $pattern, $handler); }
    /** @param callable|array|string $handler */
    public function post(string $pattern, $handler): void { $this->add('POST', $pattern, $handler); }

    /** @param callable|array|string $handler */
    public function add(string $method, string $pattern, $handler): void
    {
        [$regex, $params] = $this->compilePattern($pattern);
        $this->routes[$method][] = [
            'pattern' => $pattern,
            'regex' => $regex,
            'params' => $params,
            'handler' => $handler,
        ];
    }

    public function dispatch(Request $request): Response
    {
        $method = $request->getMethod();
        $path = $request->getPath();
        $candidates = $this->routes[$method] ?? [];

        foreach ($candidates as $route) {
            if (preg_match($route['regex'], $path, $matches)) {
                $params = [];
                foreach ($route['params'] as $name) {
                    if (isset($matches[$name])) {
                        $params[$name] = $matches[$name];
                    }
                }
                return $this->invokeHandler($route['handler'], $request, $params);
            }
        }

        return Response::html($this->render404($path), 404);
    }

    /** @return array{0:string,1:array<int,string>} */
    private function compilePattern(string $pattern): array
    {
        // Convert /blog/{slug} to regex with named capture
        $paramNames = [];
        $regex = preg_replace_callback('#\{([a-zA-Z_][a-zA-Z0-9_]*)\}#', function ($m) use (&$paramNames) {
            $paramNames[] = $m[1];
            return '(?P<' . $m[1] . '>[a-z0-9\-]+)';
        }, $pattern);
        $regex = '#^' . $regex . '$#i';
        return [$regex, $paramNames];
    }

    /**
     * @param callable|array|string $handler
     * @param array<string,string> $params
     */
    private function invokeHandler($handler, Request $request, array $params): Response
    {
        if (is_array($handler) && count($handler) === 2 && is_string($handler[0])) {
            $className = $handler[0];
            $methodName = $handler[1];
            $controller = new $className();
            return $controller->$methodName($request, $params);
        }
        if (is_callable($handler)) {
            $result = $handler($request, $params);
            return $result instanceof Response ? $result : Response::html((string)$result);
        }
        if (is_string($handler)) {
            // Static string response
            return Response::html($handler);
        }
        return Response::html('Invalid route handler', 500);
    }

    private function render404(string $path): string
    {
        $title = '404 Not Found';
        $body = '<div class="container py-5"><h1 class="display-5">404</h1><p>Page not found: ' . htmlspecialchars($path) . '</p></div>';
        return '<!doctype html><html lang="tr"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">'
            . '<title>' . $title . '</title>'
            . '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">'
            . '</head><body>' . $body . '</body></html>';
    }
}
