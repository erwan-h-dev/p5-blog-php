<?php

namespace App\Core;

use App\Core\Config;
use Twig\Environment;
use App\Core\EntityManager;
use App\Core\EntityRepository;
use Twig\Loader\FilesystemLoader;

class Twig
{
    private $twig;
    private $config;
    public $entityManager;

    public function __construct(Config $config)
    {
        $this->config = $config;
        $loader = new FilesystemLoader($config->getParameter('root') . '/template/');

        $entityRepository = new EntityRepository();
        $entityRepository->setConnexion($this->config->getParameter('database_dns'), $this->config->getParameter('database_user'), $this->config->getParameter('database_password'));
        $this->entityManager = new EntityManager($entityRepository);

        $twigConfig = [];

        if ($this->config->getParameter('env') == 'prod') {
            $twigConfig = [
                'cache' => $this->config->getParameter()['root'] . 'var/cache'
            ];
        }

        $this->twig = new Environment($loader, $twigConfig);

        $this->twig->addFunction(new \Twig\TwigFunction('path', [$this, 'generateRoute']));
        $this->twig->addFunction(new \Twig\TwigFunction('getEntity', [$this, 'getEntity']));
        $this->twig->addFunction(new \Twig\TwigFunction('makePath', [$this, 'makePath']));
        $this->twig->addFunction(new \Twig\TwigFunction('getCollection', [$this, 'getCollection']));
        $this->twig->addFunction(new \Twig\TwigFunction('isFollowing', [$this, 'isFollowing']));
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

    public function getEntity(String $entityName, int $id)
    {
        $entity = $this->entityManager->getRepository("App\Entity\\" . ucfirst($entityName))->find($id);
        return $entity;
    }

    public function makePath(string $path)
    {
        return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $path;
    }

    public function getCollection(String $entityName, array $relationProperty)
    {
        $comments = $this->entityManager->getRepository("App\Entity\\" . ucfirst($entityName))->findBy($relationProperty);

        return $comments;
    }

    public function isFollowing(int $currentUserId, int $userId)
    {
        $isFollowing = $this->entityManager->getRepository("App\Entity\Follow")->findOneBy(['follower' => $currentUserId, 'following' => $userId]);
        return !is_null($isFollowing);
    }
}
