<?php

namespace App\Repository;

use App\Core\EntityManager;
use App\Core\EntityRepository;
use App\Entity\Comment;

class CommentRepository extends EntityManager
{
    public function __construct(EntityRepository $entityRepository)
    {
        parent::__construct($entityRepository, Comment::class);
    }
}
