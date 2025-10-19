<?php
declare(strict_types=1);

namespace App\Core;

use PDO; use PDOException;

final class DB
{
    private static ?PDO $pdo=null;
    public static function init(array $cfg): void
    {
        if (self::$pdo) return; try {
            $opt = ($cfg['options'] ?? []) + [
                PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES=>false,
            ];
            self::$pdo = new PDO($cfg['dsn'],$cfg['username'],$cfg['password'],$opt);
        } catch (PDOException $e) { self::$pdo=null; }
    }
    public static function pdo(): ?PDO { return self::$pdo; }
}
