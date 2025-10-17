<?php
declare(strict_types=1);

namespace App\Core;

abstract class Controller
{
    /** @var array<string,mixed> */
    protected array $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    protected function view(string $template, array $data = []): string
    {
        $view = new View($this->config);
        return $view->render($template, $data);
    }
}
