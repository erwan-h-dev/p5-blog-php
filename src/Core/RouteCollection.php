<?php

namespace App\Core;

use App\Core\Route;

class RouteCollection
{
    private array $routes = [];

    public function addRoute(Route $route)
    {
        $this->routes[] = $route;
    }
    public function getRoutes()
    {
        return $this->routes;
    }
}
