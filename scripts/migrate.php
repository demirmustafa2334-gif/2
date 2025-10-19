<?php
declare(strict_types=1);

$root = dirname(__DIR__);
require $root . '/app/bootstrap.php';

use App\Core\DB;

$pdo = DB::pdo(); if(!$pdo){fwrite(STDERR,"DB yok. config/database.php\n"); exit(1);} 
$sql = file_get_contents($root.'/scripts/schema.sql') ?: '';
$pdo->exec($sql);
echo "Migration tamam.\n";
