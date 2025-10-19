<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\DB; use PDO;

final class City
{
    public static function all(): array { $pdo=DB::pdo(); if(!$pdo) return []; return $pdo->query('SELECT id,name,slug FROM cities ORDER BY name')->fetchAll(PDO::FETCH_ASSOC) ?: []; }
    public static function findBySlug(string $slug): ?array { $pdo=DB::pdo(); if(!$pdo) return null; $st=$pdo->prepare('SELECT * FROM cities WHERE slug=?'); $st->execute([$slug]); return $st->fetch(PDO::FETCH_ASSOC)?:null; }
    public static function create(string $name,string $slug): void { $pdo=DB::pdo(); if(!$pdo) return; $st=$pdo->prepare('INSERT INTO cities(name,slug) VALUES(?,?)'); $st->execute([$name,$slug]); }
}
