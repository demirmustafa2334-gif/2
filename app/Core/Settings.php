<?php
declare(strict_types=1);

namespace App\Core;

use App\Core\DB; use PDO;

final class Settings
{
    public static function getAll(): array
    {
        $pdo = DB::pdo(); if(!$pdo) return [];
        $stmt = $pdo->query('SELECT `key`,`value` FROM settings');
        $out=[]; foreach($stmt?->fetchAll(PDO::FETCH_ASSOC)?:[] as $r){ $out[$r['key']]=json_decode($r['value'],true); }
        return $out;
    }
}
