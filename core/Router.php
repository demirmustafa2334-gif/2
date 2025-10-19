<?php
namespace Core;

class Router
{
    private array $routes = [];

    public function get(string $pattern, callable $handler): void
    {
        $this->routes['GET'][] = [$this->normalize($pattern), $handler];
    }

    public function post(string $pattern, callable $handler): void
    {
        $this->routes['POST'][] = [$this->normalize($pattern), $handler];
    }

    public function dispatch(string $method, string $uri)
    {
        $method = strtoupper($method);
        $path = parse_url($uri, PHP_URL_PATH) ?? '/';

        foreach ($this->routes[$method] ?? [] as [$pattern, $handler]) {
            $params = [];
            if ($this->match($pattern, $path, $params)) {
                return $handler(...array_values($params));
            }
        }

        http_response_code(404);
        return null;
    }

    private function normalize(string $pattern): string
    {
        $pattern = trim($pattern);
        if ($pattern === '') {
            return '/';
        }
        if ($pattern[0] !== '/') {
            $pattern = '/' . $pattern;
        }
        return rtrim($pattern, '/') ?: '/';
    }

    private function match(string $pattern, string $path, array &$params): bool
    {
        $patternParts = explode('/', trim($pattern, '/'));
        $pathParts = explode('/', trim($path, '/'));

        if (count($patternParts) !== count($pathParts)) {
            return false;
        }

        $params = [];
        foreach ($patternParts as $i => $part) {
            if (preg_match('/^\{([a-zA-Z_][a-zA-Z0-9_]*)\}$/', $part, $m)) {
                $params[$m[1]] = urldecode($pathParts[$i]);
                continue;
            }
            if ($part !== $pathParts[$i]) {
                return false;
            }
        }
        return true;
    }
}
