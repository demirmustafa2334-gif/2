<?php
declare(strict_types=1);

namespace App\Core;

final class View
{
    /** @var array<string,mixed> */
    private array $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    public function render(string $template, array $data = []): string
    {
        $templateFile = BASE_PATH . '/app/Views/' . ltrim($template, '/') . '.php';
        if (!is_file($templateFile)) {
            throw new \RuntimeException("View '$template' not found");
        }

        extract($data, EXTR_SKIP);

        ob_start();
        include BASE_PATH . '/app/Views/layouts/main.php';
        return (string) ob_get_clean();
    }

    public static function e(?string $value): string
    {
        return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
    }
}
