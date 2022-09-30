<?php

namespace App\Core;

use App\Core\Config;
use App\Core\Routing\Routing;
use App\Core\Session;

class Kernel
{

    public function __construct()
    {
        ob_start();
        $routing = new Routing();

        $controller = $routing->getController();
    }
}
