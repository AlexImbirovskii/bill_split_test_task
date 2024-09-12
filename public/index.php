<?php

require_once __DIR__ . '/../vendor/autoload.php';
use App\Kernel\Kernel;

try {
    $kernel = (new Kernel())->loadEnv()->handleRequest();
} catch (Exception $e) {
    die(".env does not exist: " . $e->getMessage());
}