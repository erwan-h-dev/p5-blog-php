<?php

namespace App\Core\Routing;

use App\Core\Routing\Route;
use LogicException;
use App\Core\Config;
use App\Core\Routing\RouteCollection;

use ReflectionClass;
use Symfony\Component\Yaml\Yaml;
use App\Controller\ErrorController;
 
class Routing
{
    private $root;
    private $controller;
    private $routeCollection;
    private $config;

    public function __construct()
    {
        $this->config = new Config();
        $this->routeCollection = new RouteCollection();
    }

    private function loadRoot()
    {

        $parametersFile = __DIR__ . '/../../../Config/routing.yaml';

        if (!file_exists($parametersFile)) {
            throw new LogicException();
        }

        $params = Yaml::parse(file_get_contents($parametersFile));

        foreach ($params['routing'] as $routeName => $param) {
            $root = "";
            $route = new Route($routeName, $param);
            $this->routeCollection->addRoute($route);
        }

        $this->config->setRouteCollection($this->routeCollection);
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
            $controller->setConfig($this->config);
            $controller->error404();
            return;
        }

        $contoller = '\\App\\Controller\\' . $route->getController();

        $controllerClassName = new $contoller();

        $controllerClassName->setConfig($this->config);

        $controllerClassName->{$route->getAction()}($route->getParameters());
    }
}