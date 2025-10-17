<?php
declare(strict_types=1);

namespace App\Core;

final class Security
{
    public static function ensureCsrfToken(): string
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return (string)$_SESSION['csrf_token'];
    }

    public static function validateCsrf(?string $token): bool
    {
        return is_string($token) && !empty($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }

    public static function slugify(string $text): string
    {
        $text = strtolower(trim($text));
        $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text) ?: $text;
        $text = preg_replace('/[^a-z0-9]+/i', '-', $text) ?? '-';
        $text = trim($text, '-');
        return $text ?: 'n-a';
    }
}
