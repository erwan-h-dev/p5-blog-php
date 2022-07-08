<?php

namespace App\Repository;

use App\Core\EntityManager;
use App\Core\EntityRepository;
use App\Entity\Post;

class PostRepository extends EntityManager
{
    public function __construct(EntityRepository $entityRepository)
    {
        parent::__construct($entityRepository, Post::class);
    }
}
