<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\DB; use PDO;

final class Post
{
    public static function latest(int $limit=20): array { $pdo=DB::pdo(); if(!$pdo) return []; $st=$pdo->prepare('SELECT id,title,slug,content,district_id,created_at FROM posts ORDER BY created_at DESC LIMIT ?'); $st->bindValue(1,$limit,PDO::PARAM_INT); $st->execute(); return $st->fetchAll(PDO::FETCH_ASSOC)?:[]; }
    public static function findBySlug(string $slug): ?array { $pdo=DB::pdo(); if(!$pdo) return null; $st=$pdo->prepare('SELECT * FROM posts WHERE slug=?'); $st->execute([$slug]); return $st->fetch(PDO::FETCH_ASSOC)?:null; }
    public static function create(string $title,string $slug,string $content,int $districtId=0): void { $pdo=DB::pdo(); if(!$pdo) return; $st=$pdo->prepare('INSERT INTO posts(title,slug,content,district_id) VALUES(?,?,?,?)'); $st->execute([$title,$slug,$content,$districtId?:null]); }
}
