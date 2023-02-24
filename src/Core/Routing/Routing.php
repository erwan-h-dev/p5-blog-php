<?php

namespace App\Core\Routing;

use LogicException;
use App\Core\Config;
use ReflectionClass;
use App\Core\Session;

use App\Core\Routing\Route;
use Symfony\Component\Yaml\Yaml;
use App\Controller\ErrorController;
use App\Core\Routing\RouteCollection;

class Routing
{
    private $routeCollection;
    private $config;
    private $session;

    public function __construct()
    {
        $this->config = new Config();
        $this->routeCollection = new RouteCollection();
        $this->session = new Session();
    }

    private function loadRoot()
    {
        $parametersFile = __DIR__ . '/../../../Config/routing.yaml';

        if (!file_exists($parametersFile)) {
            throw new LogicException();
        }

        $params = Yaml::parse(file_get_contents($parametersFile));

        foreach ($params['routing'] as $routeName => $param) {
            $route = new Route($routeName, $param);
            $this->routeCollection->addRoute($route);
        }

        $this->config->setRouteCollection($this->routeCollection);
    }

    public function matchRoute()
    {
        if (isset($_GET['RoutePath'])) {
            $path = $_GET['RoutePath'];
            unset($_GET['RoutePath']);

            foreach ($this->routeCollection->getRoutes() as $route) {
                if ($route->match($path, $this->session->getSession('role'))) {
                    return  $route;
                }
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
            $controller->setConfig($this->config, $this->routeCollection->getRouteByName('error_404'));
            $controller->error404();
            return;
        }

        $contoller = '\\App\\Controller\\' . $route->getController();

        $controllerClassName = new $contoller();

        $controllerClassName->setConfig($this->config, $route);

        $controllerClassName->{$route->getAction()}($route->getParameters());
    }
}
