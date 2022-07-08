<?php

namespace App\Core;

use App\Core\Config;
use App\Core\Routing;

class Kernel
{

    public function __construct()
    {
        session_start();

        if (!isset($_SESSION['user'])) {
            $_SESSION['role'] = "anonymous";
        }

        $routing = new Routing();

        $controller = $routing->getController();
    }
}
