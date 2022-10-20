<?php

namespace App\Repository;

use App\Core\EntityManager;
use App\Core\EntityRepository;
use App\Entity\Follow;

class FollowRepository extends EntityManager
{
    public function __construct(EntityRepository $entityRepository)
    {
        parent::__construct($entityRepository, Follow::class);
    }
}
