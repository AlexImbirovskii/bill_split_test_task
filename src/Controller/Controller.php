<?php

namespace App\Controller;

use App\Controller\Interface\ControllerInterface;

class Controller implements ControllerInterface
{
    private array $routes = [];

    public function getRoutes(): array
    {
        return $this->routes;
    }
}