<?php

namespace App\Kernel;

use Exception;
use App\Controller\UserController;
use App\Kernel\Interface\KernelInterface;

class Kernel implements KernelInterface
{
    function loadEnv(): self
    {
        $file = __DIR__ . '/../../.env';

        if (!file_exists($file)) {
            throw new Exception(".env file not found");
        }

        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (str_starts_with(trim($line), '#')) {
                continue;
            }

            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            putenv("$name=$value");
        }

        return $this;
    }

    function handleRequest(): self
    {
        $request = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        switch ($request) {
            case '/' :
                require __DIR__ . '/../../views/home.php';
                break;
            case '/api/users' :
                $controller = new UserController();

                if (array_key_exists($method, $controller->getRoutes())) {
                    echo call_user_func([$controller, $controller->getRoutes()[$method]]);
                } else {
                    http_response_code(405);
                    echo "Method Not Allowed";
                }

                break;
            default:
                http_response_code(404);
                require __DIR__ . '/../../views/404.php';
                break;
        }

        return $this;
    }
}