<?php

namespace App\Core;

use App\Core\Config;
use \Twig\Environment;
use \Twig\Loader\FilesystemLoader;

class Controller
{

    private $twig;
    private $loader;
    private $entityManager;

    public function setConfig(Config $config)
    {

        $this->setTwig($config);

        $this->setConnexion($config);
    }

    public function setTwig(Config $config)
    {
        $this->loader = new FilesystemLoader($config->getParameter('root') . '/template/');
        $this->twig = new Environment($this->loader, [
            // 'cache' => $config->getParameter()['root'] . 'var/cache'
        ]);
    }

    public function setConnexion(Config $config)
    {
        $this->entityManager = new EntityManager();

        $this->entityManager->connexion($config->getParameter('database_dns'), $config->getParameter('database_user'), $config->getParameter('database_password'));
    }

    public function render(String $template, array $params)
    {
        echo $this->twig->render($template, $params);
    }
}
