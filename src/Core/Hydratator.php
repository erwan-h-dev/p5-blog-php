<?php

namespace App\Core;

class Hydratator{

    public static function hydrate(array $entityArray, $class)
    {
        $entity = new $class();
        foreach ($entityArray as $key => $value) {
            $methode = 'set' . ucfirst($key);

            // $reflectionFunc = new ReflectionFunction($class, $methode);
            // $reflectionParams = $reflectionFunc->getParameters();
            // $reflectionType = $reflectionParams[0]->getType();

            // if($reflectionType->getName() == 'DateTime'){
            //     $value = new DateTime($value);
            // }

            $entity->$methode($value);
        }

        return $entity;
    }
}