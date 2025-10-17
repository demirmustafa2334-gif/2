<?php
declare(strict_types=1);

namespace App\Core;

final class Response
{
    private string $body;
    private int $statusCode;
    /** @var array<string,string> */
    private array $headers;

    /** @param array<string,string> $headers */
    public function __construct(string $body = '', int $statusCode = 200, array $headers = [])
    {
        $this->body = $body;
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }

    public static function html(string $html, int $statusCode = 200): self
    {
        return new self($html, $statusCode, ['Content-Type' => 'text/html; charset=UTF-8']);
    }

    /** @param array<string,mixed> $data */
    public static function json(array $data, int $statusCode = 200): self
    {
        return new self(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), $statusCode, ['Content-Type' => 'application/json']);
    }

    public static function redirect(string $url, int $statusCode = 302): self
    {
        return new self('', $statusCode, ['Location' => $url]);
    }

    public function getBody(): string { return $this->body; }
    public function getStatusCode(): int { return $this->statusCode; }
    /** @return array<string,string> */
    public function getHeaders(): array { return $this->headers; }
}
