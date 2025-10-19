<?php
declare(strict_types=1);

namespace App\Core;

final class Router
{
    private array $routes = [ 'GET'=>[], 'POST'=>[] ];
    private array $config;
    public function __construct(array $config){ $this->config=$config; }
    public function get(string $p, $h): void { $this->add('GET',$p,$h); }
    public function post(string $p, $h): void { $this->add('POST',$p,$h); }
    public function add(string $m, string $p, $h): void {
        [$regex,$params] = $this->compile($p);
        $this->routes[$m][] = ['regex'=>$regex,'params'=>$params,'handler'=>$h];
    }
    public function dispatch(Request $req): Response
    {
        $method = $req->getMethod(); $path = $req->getPath();
        foreach ($this->routes[$method] ?? [] as $r) {
            if (preg_match($r['regex'],$path,$m)){
                $params=[]; foreach($r['params'] as $n){ if(isset($m[$n])) $params[$n]=$m[$n]; }
                return $this->invoke($r['handler'],$req,$params);
            }
        }
        return Response::html('<div class="container py-5"><h1>404</h1><p>Sayfa bulunamadı.</p></div>',404);
    }
    private function compile(string $p): array
    {
        $names=[]; $regex=preg_replace_callback('#\{([a-zA-Z_][a-zA-Z0-9_]*)\}#',function($m)use(&$names){$names[]=$m[1];return '(?P'.$m[0].'>[a-z0-9\-]+)';},$p);
        return ['#^'.$regex.'$#i',$names];
    }
    private function invoke($h, Request $req, array $params): Response
    {
        if (is_array($h)) { $c=new $h[0](); return $c->{$h[1]}($req,$params); }
        if (is_callable($h)) { $r=$h($req,$params); return $r instanceof Response? $r: Response::html((string)$r); }
        return Response::html('Hatalı yönlendirme',500);
    }
}
