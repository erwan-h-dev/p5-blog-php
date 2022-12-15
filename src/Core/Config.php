<?php

namespace App\Core;

use LogicException;
use App\Core\Routing\RouteCollection;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Dotenv\Dotenv;

class Config
{
    private $parameters;
    private $routeCollection;

    public function __construct()
    {
        $this->loadParams();
        $this->loadEnv();
    }

    private function setParameter($key, $value)
    {
        $this->parameters[strtolower($key)] = $value;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function getParameter($key)
    {
        return $this->parameters[$key];
    }

    private function loadEnv()
    {
        $dotenv = new Dotenv();
        $dotenv->load(__DIR__ . '/../../.env');

        foreach ($_ENV as $key => $param) {
            if (strpos($key, 'BLOG_') !== false) {
                $this->setParameter(substr($key, 5), $param);
            }
        }
    }

    private function loadParams()
    {
        $parametersFile = __DIR__ . '/../../Config/parameters.yaml';

        if (!file_exists($parametersFile)) {
            throw new LogicException();
        }

        $params = Yaml::parse(file_get_contents($parametersFile));

        foreach ($params['global'] as $key => $param) {
            $this->setParameter($key, $param);
        }
    }

    public function setRouteCollection(RouteCollection $routeCollection)
    {
        $this->routeCollection = $routeCollection;
    }

    public function getRouteCollection(): RouteCollection
    {
        return $this->routeCollection;
    }
}
