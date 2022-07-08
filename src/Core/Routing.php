<?php

namespace App\Core;

use App\Core\Route;
use LogicException;
use App\Core\Config;
use App\Core\RouteCollection;

use ReflectionClass;
use Symfony\Component\Yaml\Yaml;
use App\Controller\ErrorController;
 
class Routing
{
    private $root;
    private $controller;
    private $routeCollection;

    private function loadRoot()
    {

        $parametersFile = __DIR__ . '/../../Config/routing.yaml';

        $this->routeCollection = new RouteCollection();

        if (!file_exists($parametersFile)) {
            throw new LogicException();
        }

        $params = Yaml::parse(file_get_contents($parametersFile));

        foreach ($params['routing'] as $key => $param) {
            $root = "";
            $route = new Route($param);
            $this->routeCollection->addRoute($route);
        }
    }

    public function matchRoute()
    {
        $path = $_GET['p'];

        foreach ($this->routeCollection->getRoutes() as $route) {
            if ($route->match($path)) {
                return  $route;
            }
        }

        return false;
    }

    public function getController()
    {
        $this->loadRoot();

        $route = $this->matchRoute();

        if ($route === false) {
            $controller = new ErrorController();
            $controller->setConfig(new Config());
            $controller->error404();
            return;
        }

        $contoller = '\\App\\Controller\\' . $route->getController();

        $controllerClassName = new $contoller();

        $controllerClassName->setConfig(new Config());

        $controllerClassName->{$route->getAction()}($route->getParameters());
    }
}
