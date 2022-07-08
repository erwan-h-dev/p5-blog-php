<?php

namespace App\Repository;

use App\Core\EntityManager;
use App\Core\EntityRepository;
use App\Entity\User;

class UserRepository extends EntityManager
{
    public function __construct(EntityRepository $entityRepository)
    {
        parent::__construct($entityRepository, User::class);
    }
}
