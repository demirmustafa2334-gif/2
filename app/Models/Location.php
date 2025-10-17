<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\DB;
use PDO;

final class Location
{
    /** @return array<int, array{id:int,name:string,slug:string}> */
    public static function allDistricts(): array
    {
        $pdo = DB::pdo();
        if (!$pdo) { return []; }
        $stmt = $pdo->query('SELECT id, name, slug FROM districts ORDER BY name');
        return $stmt?->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }

    /** @return array<int, array{id:int,name:string,slug:string}> */
    public static function neighborhoodsByDistrict(int $districtId): array
    {
        $pdo = DB::pdo();
        if (!$pdo) { return []; }
        $stmt = $pdo->prepare('SELECT id, name, slug FROM neighborhoods WHERE district_id = ? ORDER BY name');
        $stmt->execute([$districtId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }

    /** @return array{id:int,name:string,slug:string,meta_title:?string,meta_description:?string}|null */
    public static function findDistrictBySlug(string $slug): ?array
    {
        $pdo = DB::pdo();
        if (!$pdo) { return null; }
        $stmt = $pdo->prepare('SELECT id, name, slug, meta_title, meta_description FROM districts WHERE slug = ?');
        $stmt->execute([$slug]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    /** @return array{id:int,name:string,slug:string,district_id:int,meta_title:?string,meta_description:?string}|null */
    public static function findNeighborhoodBySlug(string $slug): ?array
    {
        $pdo = DB::pdo();
        if (!$pdo) { return null; }
        $stmt = $pdo->prepare('SELECT id, name, slug, district_id, meta_title, meta_description FROM neighborhoods WHERE slug = ?');
        $stmt->execute([$slug]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }
}
