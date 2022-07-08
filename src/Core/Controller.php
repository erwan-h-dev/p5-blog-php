<?php

namespace App\Core;

use App\Core\Config;
use App\Core\EntityManager;
use \Twig\Environment;
use \Twig\Loader\FilesystemLoader;

class Controller
{

    private $twig;
    private $loader;
    public $entityManager;

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
        $entityRepository = new EntityRepository();

        $entityRepository->setConnexion($config->getParameter('database_dns'), $config->getParameter('database_user'), $config->getParameter('database_password'));
        $this->entityManager = new EntityManager($entityRepository);
    }

    public function render(String $template, array $params)
    {
        if (isset($_SESSION['user'])) {
            $user = $this->entityManager->getRepository(User::class)->findOneBy(['id' => $_SESSION['id']]);
            $params['user'] = $user;
        }

        echo $this->twig->render($template, $params);
    }
}
