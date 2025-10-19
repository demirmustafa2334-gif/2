<?php
declare(strict_types=1);

namespace App\Core;

abstract class Controller
{
    protected function render(string $view, array $data = [], ?array $meta=null): Response
    {
        $html = View::render($view,$data,$meta);
        return Response::html($html);
    }
}
