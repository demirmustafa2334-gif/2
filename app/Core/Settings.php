<?php
declare(strict_types=1);

namespace App\Core;

use App\Core\DB;
use PDO;

final class Settings
{
    /** @return array<string,mixed> */
    public static function getAll(): array
    {
        $pdo = DB::pdo();
        if (!$pdo) { return []; }
        $stmt = $pdo->query('SELECT `key`, `value` FROM settings');
        $map = [];
        foreach ($stmt?->fetchAll(PDO::FETCH_ASSOC) ?: [] as $row) {
            $map[$row['key']] = json_decode($row['value'], true);
        }
        return $map;
    }

    /**
     * @param array<string,mixed> $value
     */
    public static function set(string $key, array $value): void
    {
        $pdo = DB::pdo();
        if (!$pdo) { return; }
        $stmt = $pdo->prepare('REPLACE INTO settings (`key`, `value`) VALUES (?, JSON_OBJECT())');
        // PDO can't bind JSON_OBJECT directly portably; use simple approach
        $json = json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $stmt = $pdo->prepare('REPLACE INTO settings (`key`, `value`) VALUES (?, ?)');
        $stmt->execute([$key, $json]);
    }
}
