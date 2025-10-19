<?php
namespace Core;

class View
{
    private string $layout = 'layouts/main';

    public function setLayout(string $layout): void
    {
        $this->layout = $layout;
    }

    public function render(string $template, array $data = []): void
    {
        extract($data, EXTR_SKIP);
        $viewPath = dirname(__DIR__) . '/app/Views/' . $template . '.php';
        $layoutPath = dirname(__DIR__) . '/app/Views/' . $this->layout . '.php';

        ob_start();
        if (is_file($viewPath)) {
            require $viewPath;
        } else {
            echo "View not found: {$template}";
        }
        $content = ob_get_clean();

        if (is_file($layoutPath)) {
            require $layoutPath;
        } else {
            echo $content; // fallback if no layout
        }
    }
}
