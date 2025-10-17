<?php
declare(strict_types=1);

namespace App\Core;

final class Request
{
    /** @var array<string,string> */
    private array $headers;
    /** @var array<string,mixed> */
    private array $get;
    /** @var array<string,mixed> */
    private array $post;
    /** @var array<string,string> */
    private array $server;
    private string $method;
    private string $uri;

    private function __construct(array $headers, array $get, array $post, array $server)
    {
        $this->headers = $headers;
        $this->get = $get;
        $this->post = $post;
        $this->server = $server;
        $this->method = strtoupper($server['REQUEST_METHOD'] ?? 'GET');
        $this->uri = $server['REQUEST_URI'] ?? '/';
    }

    public static function fromGlobals(): self
    {
        return new self(self::parseHeaders(), $_GET, $_POST, $_SERVER);
    }

    /** @return array<string,string> */
    private static function parseHeaders(): array
    {
        $headers = [];
        foreach ($_SERVER as $key => $value) {
            if (strpos($key, 'HTTP_') === 0) {
                $name = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($key, 5)))));
                $headers[$name] = (string)$value;
            }
        }
        if (isset($_SERVER['CONTENT_TYPE'])) {
            $headers['Content-Type'] = (string)$_SERVER['CONTENT_TYPE'];
        }
        if (isset($_SERVER['CONTENT_LENGTH'])) {
            $headers['Content-Length'] = (string)$_SERVER['CONTENT_LENGTH'];
        }
        return $headers;
    }

    public function getMethod(): string { return $this->method; }

    public function getPath(): string
    {
        $path = parse_url($this->uri, PHP_URL_PATH) ?: '/';
        // Normalize trailing slash (keep root only)
        if ($path !== '/' && substr($path, -1) === '/') {
            $path = rtrim($path, '/');
        }
        return $path;
    }

    public function getUri(): string { return $this->uri; }

    /** @return array<string,mixed> */
    public function getQueryParams(): array { return $this->get; }

    /** @return array<string,mixed> */
    public function getParsedBody(): array { return $this->post; }

    public function getQuery(string $key, $default = null)
    {
        return $this->get[$key] ?? $default;
    }

    public function getPost(string $key, $default = null)
    {
        return $this->post[$key] ?? $default;
    }

    public function getHeader(string $name, ?string $default = null): ?string
    {
        return $this->headers[$name] ?? $default;
    }

    public function getClientIp(): string
    {
        $server = $this->server;
        foreach (['HTTP_X_FORWARDED_FOR', 'HTTP_CLIENT_IP', 'REMOTE_ADDR'] as $key) {
            if (!empty($server[$key])) {
                $val = (string)$server[$key];
                if ($key === 'HTTP_X_FORWARDED_FOR') {
                    $parts = explode(',', $val);
                    return trim($parts[0]);
                }
                return $val;
            }
        }
        return '0.0.0.0';
    }
}
