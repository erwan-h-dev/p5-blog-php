<?php

namespace App\Core;

use App\Core\Twig;
use App\Core\Config;
use App\Entity\User;
use App\Core\Session;
use App\Core\EntityManager;
use App\Core\Routing\Route;

class Controller
{
    protected $session;
    private $twig;
    public $entityManager;
    private $config;
    private $route;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function setConfig(Config $config, Route $route)
    {
        $this->route = $route;
        $this->config = $config;
        $this->setConnexion();
        $this->twig = new Twig($config);

        if ($this->getUser()) {
            $this->twig->addGlobal('currentUser', $this->getUser());
        }

        $this->twig->addGlobal('currentRoute', $this->route->getName());
    }

    public function setConnexion()
    {
        $entityRepository = new EntityRepository();
        $entityRepository->setConnexion($this->config->getParameter('database_dns'), $this->config->getParameter('database_user'), $this->config->getParameter('database_password'));
        $this->entityManager = new EntityManager($entityRepository);
    }

    public function render(String $template, array $params)
    {
        echo $this->twig->render($template, $params);
    }

    public function redirectRoute(string $routeName, array $params = [])
    {
        header('Location: ' . $this->config->getRouteCollection()->generate($routeName, $params));
    }

    public function setUser($userId, string $userRole)
    {
        $this->session->setSession('user', $userId);
        $this->session->setSession('role', $userRole);
    }

    public function getUser()
    {
        $userRepository = $this->entityManager->getRepository(User::class);
        if ($this->session->getSession('user')) {
            return $userRepository->find($this->session->getSession('user'));
        }

        return null;
    }

    public function destroySession()
    {
        $this->session->destroySession();
    }
}
