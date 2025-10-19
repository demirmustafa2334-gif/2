<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\DB; use PDO;

final class District
{
    public static function byCityId(int $cityId): array { $pdo=DB::pdo(); if(!$pdo) return []; $st=$pdo->prepare('SELECT id,city_id,name,slug FROM districts WHERE city_id=? ORDER BY name'); $st->execute([$cityId]); return $st->fetchAll(PDO::FETCH_ASSOC)?:[]; }
    public static function allWithCity(): array { $pdo=DB::pdo(); if(!$pdo) return []; return $pdo->query('SELECT d.*, c.name AS city_name FROM districts d JOIN cities c ON c.id=d.city_id ORDER BY c.name,d.name')->fetchAll(PDO::FETCH_ASSOC)?:[]; }
    public static function find(int $id): ?array { $pdo=DB::pdo(); if(!$pdo) return null; $st=$pdo->prepare('SELECT * FROM districts WHERE id=?'); $st->execute([$id]); return $st->fetch(PDO::FETCH_ASSOC)?:null; }
    public static function findBySlug(string $slug): ?array { $pdo=DB::pdo(); if(!$pdo) return null; $st=$pdo->prepare('SELECT * FROM districts WHERE slug=?'); $st->execute([$slug]); return $st->fetch(PDO::FETCH_ASSOC)?:null; }
    public static function create(int $cityId,string $name,string $slug): void { $pdo=DB::pdo(); if(!$pdo) return; $st=$pdo->prepare('INSERT INTO districts(city_id,name,slug) VALUES(?,?,?)'); $st->execute([$cityId,$name,$slug]); }
}
