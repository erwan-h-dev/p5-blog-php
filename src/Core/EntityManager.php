<?php

namespace App\Core;

use PDO;
use LogicException;
use App\Core\EntityRepository;

class EntityManager
{

    private $entityRepository;
    private $class;

    public function __construct(EntityRepository $entityRepository, $class = null)
    {

        $this->entityRepository = $entityRepository;
        $this->class = $class;
    }

    public function getRepository($entity)
    {
        $entityName = explode('\\', $entity);

        $class = 'App\\Repository\\' . $entityName[2] . 'Repository';

        return new $class($this->entityRepository);
    }   

    private function persistEntity(String $sql, array $values): int
    {
        
        $pdo = $this->entityRepository->getPdo();
    
        $statement = $pdo->prepare($sql);

        $sqlResult = $statement->execute($values);

        if(!$sqlResult){
            var_dump($statement->errorInfo());
            die;
        }

        return $pdo->lastInsertId();
    }

    public function insert($entity){
        $sql = "INSERT INTO " . lcfirst(str_replace("App\\Entity\\", "", get_class($entity))) . " (";
        $sql2 = " VALUES (";

        $parameters = $this->getParameters($entity);
        $values = [];
        foreach ($parameters as $parameter) {
            if ($parameter->getName() != 'id') {
                $sql .= " " . $parameter->getName();
                $sql2 .= " :" . $parameter->getName();
                $methode = 'get' . ucfirst($parameter->getName());

                // if not last parameter
                if (end($parameters) != $parameter) {
                    $sql .= ", ";
                    $sql2 .= ", ";
                }
                
                $values[$parameter->getName()] = $entity->$methode();
            }
        }

        $sql .= ")" . $sql2 . ")";
        var_dump($sql, $values);
        $this->persistEntity($sql, $values);
    }

    public function update($entity){
        $sql = "UPDATE " . lcfirst(str_replace("App\\Entity\\", "", get_class($entity))) . " SET ";

        $parameters = $this->getParameters($entity);
        $values = [];
        foreach ($parameters as $parameter) {
            if ($parameter->getName() != 'id') {
                $sql .= " " . $parameter->getName()." = :" . $parameter->getName();
                $methode = 'get' . ucfirst($parameter->getName());

                // if not last parameter
                if (end($parameters) != $parameter) {
                    $sql .= ", ";
                }
                
                $values[$parameter->getName()] = $entity->$methode();
            }
        }

        $sql.= " WHERE id = :id";
        $values['id'] = $entity->getId();

        $this->persistEntity($sql, $values);

    }

    private function getParameters($entity)
    {
        $reflectionClass = new \ReflectionClass($entity);
        $properties = $reflectionClass->getProperties();

        return $properties;
    }

    

    public function findOneBy($params)
    {
        $sql = "SELECT * FROM " . lcfirst(str_replace("App\\Entity\\", "", $this->class)) . " WHERE ";
        $values = [];
        foreach ($params as $key => $value) {
            $sql .= " " . $key . " = :" . $key;
            $values[$key] = $value;
            if (end($params) != $value) {
                $sql .= " AND ";
            }
        }

        $pdo = $this->entityRepository->getPdo();
        $statement = $pdo->prepare($sql);
        $statement->execute($values);
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if($result){
            return $this->hydrate($result);
        }else{
            return null;
        }
        
    }

    public function findAll()
    {
        $pdo = $this->entityRepository->getPdo();

        $statement = $pdo->prepare("SELECT * FROM " . lcfirst(str_replace("App\\Entity\\", "", $this->class)));
        $statement->execute();
        try {
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $key => $result) {
                $entities[] = $this->hydrate($result);
            }
            return $entities;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    private function hydrate($entityArray)
    {
        $entity = new $this->class();
        foreach ($entityArray as $key => $value) {
            $methode = 'set' . ucfirst($key);
            $entity->$methode($value);
        }

        return $entity;
    }


}
