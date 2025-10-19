<?php
declare(strict_types=1);

namespace App\Core;

final class Response
{
    private string $body; private int $status; private array $headers;
    public function __construct(string $b='',int $s=200,array $h=[]){$this->body=$b;$this->status=$s;$this->headers=$h;}
    public static function html(string $h,int $s=200): self { return new self($h,$s,['Content-Type'=>'text/html; charset=UTF-8']); }
    public static function json(array $d,int $s=200): self { return new self(json_encode($d,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES),$s,['Content-Type'=>'application/json']); }
    public static function redirect(string $url,int $s=302): self { return new self('', $s, ['Location'=>$url]); }
    public function getBody(): string { return $this->body; }
    public function getStatusCode(): int { return $this->status; }
    public function getHeaders(): array { return $this->headers; }
}
