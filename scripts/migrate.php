<?php
declare(strict_types=1);

// Simple migration runner

$root = dirname(__DIR__);
require $root . '/app/bootstrap.php';

use App\Core\DB;

$pdo = DB::pdo();
if (!$pdo) {
    fwrite(STDERR, "Database not connected. Check config/database.php or environment vars.\n");
    exit(1);
}

$schemaFile = $root . '/scripts/schema.sql';
$sql = file_get_contents($schemaFile) ?: '';

$pdo->exec($sql);

echo "Migration complete.\n";
