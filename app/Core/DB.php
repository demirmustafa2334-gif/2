<?php
declare(strict_types=1);

namespace App\Core;

use PDO;
use PDOException;

final class DB
{
    private static ?PDO $pdo = null;

    /** @param array{dsn:string,username:string,password:string,options?:array<mixed>} $config */
    public static function init(array $config): void
    {
        if (self::$pdo !== null) {
            return;
        }
        try {
            $options = $config['options'] ?? [];
            $defaults = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $pdo = new PDO($config['dsn'], $config['username'], $config['password'], $options + $defaults);
            self::$pdo = $pdo;
        } catch (PDOException $e) {
            // Defer hard failure; app can still render without DB during setup
            self::$pdo = null;
        }
    }

    public static function pdo(): ?PDO
    {
        return self::$pdo;
    }
}
