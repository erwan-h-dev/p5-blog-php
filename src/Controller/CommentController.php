<?php

namespace App\Controller;

use DateTime;
use App\Core\Request;
use App\Entity\Comment;
use App\Core\Controller;
use App\Core\JsonContent;

class CommentController extends Controller
{
    public function newComment()
    {
        $request = new Request();
        $now = new DateTime();
        $comment = new Comment();

        $comment->setAuthorId($this->getUser()->getId())
            ->setContent($request->getRequest('content'))
            ->setPostId($request->getRequest('postId'))
            ->setCreatedAt($now->format('Y-m-d H:i:s'))
            ->setCommentId(null)
        ;

        if(!empty($request->getRequest("commentId"))){
            $comment->setCommentId($request->getRequest("commentId"));
        }
        
        $this->entityManager->insert($comment);

        return new JsonContent(['status' => 'ok']);
    }
}