<?php

namespace App\Core\Routing;

class Route
{
    private $name;
    private $path;
    private $controller;
    private $action;
    private $roles;
    private $parameters = [];

    public function __construct(string $routeName, array $param)
    {
        $this->name = $routeName;
        $this->path = str_replace('{id}', '([0-9]+)', $param['path']);
        [$this->controller, $this->action] = explode('/', $param['controller']);
        $this->roles = $param['roles'];
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function match(string $path, ?string $role): bool
    {
        $match = preg_match('/^' . str_replace('/', '\/', $this->path) . '$/i', '/' . $path, $matches);

        if (isset($matches[1]) && in_array($role, $this->roles)) {
            $this->parameters['id'] = $matches[1];
        }

        return (0 !== $match && in_array($role, $this->roles));
    }

    public function getName(): string
    {
        return $this->name;
    }
}
