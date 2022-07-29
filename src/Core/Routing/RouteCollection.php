<?php

namespace App\Core\Routing;

use App\Core\Routing\Route;

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

    public function getRouteByName(string $name)
    {
        foreach ($this->routes as $route) {
            if ($route->getName() === $name) {
                return $route;
            }
        }
        return false;
    }


    public function generate(string $RouteName, array $parameters = [])
    {
        $route = $this->getRouteByName($RouteName);
        if ($route) {
            $path = $route->getPath();
            $path = str_replace('[^0-9]', $parameters['id'], $path);
            return $path;
        }
        return false;
    }
}
