<?php
declare(strict_types=1);

namespace App\Core;

final class Request
{
    private array $get; private array $post; private array $server; private string $method; private string $uri;
    private function __construct(array $get,array $post,array $server){$this->get=$get;$this->post=$post;$this->server=$server;$this->method=strtoupper($server['REQUEST_METHOD']??'GET');$this->uri=$server['REQUEST_URI']??'/';}
    public static function fromGlobals(): self { return new self($_GET,$_POST,$_SERVER); }
    public function getMethod(): string { return $this->method; }
    public function getPath(): string { $p=parse_url($this->uri, PHP_URL_PATH)?:'/'; return $p==='/'?'/':rtrim($p,'/'); }
    public function getQuery(string $k,$d=null){ return $this->get[$k]??$d; }
    public function getPost(string $k,$d=null){ return $this->post[$k]??$d; }
}
