<?php

namespace App\Core;

use PDO;
use App\Core\Config;

class EntityRepository
{
    private $pdo;

    public function __construct()
    {
    }

    public function setConnexion(String $dns, String $user, String $password)
    {
        $this->pdo = new PDO($dns, $user, $password);
    }

    public function getPdo()
    {
        return $this->pdo;
    }
}
