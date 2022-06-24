<?php

namespace App\Repository;

use App\Core\EntityRepository;

class UserRepository extends EntityRepository
{
    public function __construct(EntityRepository $entityRepository)
    {
        parent::__construct($entityRepository, User::class);
    }
}
