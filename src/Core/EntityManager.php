<?php

namespace App\Core;

use PDO;
use App\Core\Config;

class EntityManager
{

    private $pdo;
    private $className;
    private $class;

    public function connexion(String $dns, String $user, String $password)
    {
        $this->pdo = new PDO($dns, $user, $password);
    }

    public function insert()
    {
    }

    public function update()
    {
    }

    public function remove()
    {
    }

    public function find()
    {
    }

    public function findAll()
    {
        $query = $this->pdo->prepare('SELECT * FROM :entityName');
        $query->execute(["entityName" => $this->className]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        var_dump($results);
    }
}
