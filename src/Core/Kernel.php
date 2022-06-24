<?php

namespace App\Core;

use App\Core\Config;
use App\Core\Routing;

class Kernel
{

    public function __construct()
    {
        $routing = new Routing();
        $config = new Config();

        $controller = $routing->getController();

        $controller->setConfig($config);

        $routing->getAction($controller);
    }
}
