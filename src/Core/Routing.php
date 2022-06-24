<?php

namespace App\Core;

use LogicException;
use App\Controller\ErrorController;

class Routing
{
    private $namespace = '\\App\\Controller\\';
    private $controller;

    public function __construct()
    {
    }

    public function getController()
    {
        $params = explode('/', $_GET['p']);

        $controllerName = !empty($params[0]) ? $params[0] . 'Controller' : "HomeController";

        $classController = $this->namespace . ucfirst($controllerName);

        $this->controller = class_exists($classController) ? new $classController() : new ErrorController();

        return $this->controller;
    }

    public function getAction($controller)
    {
        $params = explode('/', $_GET['p']);

        if (!is_object($controller)) {
            throw new LogicException();
        }

        $action = isset($params[1]) ? $params[1] : "index";

        return $controller->$action();
    }
}
