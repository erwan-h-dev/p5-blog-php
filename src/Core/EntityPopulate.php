<?php

namespace App\Core;

class EntityPopulate
{
    public static function populate(array $entityArray, $entity)
    {
        foreach ($entityArray as $key => $value) {
            $methode = 'set' . ucfirst($key);
            $entity->$methode($value);
        }

        return $entity;
    }
}