<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\DB; use PDO;

final class Message
{
    public static function create(string $name,string $email,string $message): void { $pdo=DB::pdo(); if(!$pdo) return; $st=$pdo->prepare('INSERT INTO contact_messages(name,email,message) VALUES(?,?,?)'); $st->execute([$name,$email,$message]); }
    public static function latest(int $limit=100): array { $pdo=DB::pdo(); if(!$pdo) return []; $st=$pdo->prepare('SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT ?'); $st->bindValue(1,$limit,PDO::PARAM_INT); $st->execute(); return $st->fetchAll(PDO::FETCH_ASSOC)?:[]; }
}
