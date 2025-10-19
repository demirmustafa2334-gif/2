<?php
declare(strict_types=1);

namespace App\Core;

final class Security
{
    public static function csrfToken(): string { if(empty($_SESSION['csrf'])) $_SESSION['csrf']=bin2hex(random_bytes(32)); return (string)$_SESSION['csrf']; }
    public static function validateCsrf(?string $t): bool { return is_string($t) && !empty($_SESSION['csrf']) && hash_equals($_SESSION['csrf'],$t); }
    public static function slugify(string $t): string { $t = strtolower(trim($t)); $t = iconv('UTF-8','ASCII//TRANSLIT',$t) ?: $t; $t=preg_replace('/[^a-z0-9]+/','-',$t)??'-'; return trim($t,'-')?:'n-a'; }
}
