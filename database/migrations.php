<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Kernel\Kernel;
use Database\Database;

const MIGRATIONS = [
    "CREATE TABLE IF NOT EXISTS users (
        id SERIAL PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        debt DOUBLE PRECISION DEFAULT 0
    );",
];

try {
    (new Kernel())->loadEnv();
} catch (Exception $e) {
    die(".env does not exist: " . $e->getMessage());
}

$database = new Database();

$database->connect();

foreach (MIGRATIONS as $migration) {
    $database->migrate($migration);
}

$database->disconnect();

echo "Migrated";