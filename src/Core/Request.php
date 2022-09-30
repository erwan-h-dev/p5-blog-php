<?php

namespace App\Core;

class Request
{
    private array $request   = []; 
    private array $query     = [];
    private array $files     = [];

    public function __construct()
    {
        $this->initialize();
    }

    public function initialize()
    {
        $this->request = $_POST;
        $this->query = $_GET;
        
    }

    public function query(): array
    {
        return $this->query;
    }

    public function getQuery(string $key): string
    {
        if ($this->has($this->query, $key)) {
            return $this->query[$key];
        }

        return null;
    }

    public function request(): array
    {
        return $this->request;
    }

    public function getRequest(string $key): string
    {
        if ($this->has($this->request, $key)) {
            return $this->request[$key];
        }

        return null;
    }

    public function getFiles(string $key): string
    {
        if ($this->has($this->files, $key)) {
            return $this->files[$key];
        }

        return null;
    }

    private function has(array $array, string $key): bool
    {
        return isset($array[$key]);
    }

    public function isMethod(string $requestType): bool
    {
        return $_SERVER['REQUEST_METHOD'] == $requestType;
    }
}