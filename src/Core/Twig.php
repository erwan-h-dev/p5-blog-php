<?php

namespace App\Core;

use App\Core\Config;
use Twig\Environment;
use \Twig\Loader\FilesystemLoader;

class Twig
{
    private $twig;
    private $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
        $loader = new FilesystemLoader($config->getParameter('root') . '/template/');

        $this->twig = new Environment($loader, [
            // 'cache' => $this->config->getParameter()['root'] . 'var/cache'
        ]);

        $this->twig->addFunction(new \Twig\TwigFunction('path', [$this, 'generateRoute']));
    }

    public function render(String $template, array $params)
    {
        echo $this->twig->render($template, $params);
    }

    public function addGlobal($key, $value)
    {
        $this->twig->addGlobal($key, $value);
    }


    public function generateRoute(String $routeName, array $parmas = [])
    {
       return $this->config->getRouteCollection()->generate($routeName, $parmas);
    }
}