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

    public function toggleStatus($params)
    {
        $comment = $this->entityManager->getRepository(Comment::class)->find($params['id']);

        if($comment->getStatus() == 0){
            $date = new DateTime();

            $comment->setStatus(1);
            $comment->setValidatedAt($date->format('Y-m-d H:i:s'));
        }else{
            $comment->setStatus(0);
        }

        $this->entityManager->update($comment);

        return $this->redirectRoute('comments_admin');
    }

    public function removeComment($params)
    {
        $comment = $this->entityManager->getRepository(Comment::class)->find($params['id']);

        $this->entityManager->remove($comment);

        return $this->redirectRoute('comments_admin');
    }
}