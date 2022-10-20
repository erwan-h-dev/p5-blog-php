<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Core\Request;
use App\Entity\Follow;
use App\Entity\Comment;
use App\Core\Controller;
use App\Core\JsonContent;

class UserController extends Controller
{

    public function user($params)
    {
        $location = 'User';

        $userRepository = $this->entityManager->getRepository(User::class);
        $user = $userRepository->find($params['id']);

        $commentRepository = $this->entityManager->getRepository(Comment::class);
        $comments = $commentRepository->findBy(['authorId' => $user->getId()]);

        $followRepository = $this->entityManager->getRepository(Follow::class);
        
        $followers = $followRepository->findBy(['following' => $user->getId()]);
        $followings = $followRepository->findBy(['follower' => $user->getId()]);

        $postRepository = $this->entityManager->getRepository(Post::class);

        $posts = $postRepository->findBy(['authorId' => $user->getId()]);

        return $this->render('user/user.html.twig', [
            'location' => $location,
            'user' => $user,
            'posts' => $posts,
            'comments' => $comments,
            'followers' => $followers,
            'followings' => $followings,
        ]);
    }

    public function editUser($params)
    {
        $location = 'Edit User';

        $userRepository = $this->entityManager->getRepository(User::class);
        $user = $userRepository->find($params['id']);

        return $this->render('user/edit-user.html.twig', [
            'location' => $location,
            'user' => $user,
            
        ]);
    }

    public function followUser($params)
    {
        $followRppository = $this->entityManager->getRepository(Follow::class);

        $follow = $followRppository->findBy(['follower' => $this->getUser()->getId(), 'following' => $params['id']]);
        if(!empty($follow)){
            $this->entityManager->remove($follow[0]);

            return new JsonContent(['status' => 'unfollow']);
        }else{
            $follow = new Follow();
            $follow->setFollower($this->GetUser()->getId())
                ->setFollowing($params['id']);
            $this->entityManager->insert($follow);
            
            return new JsonContent(['status' => 'follow']);
        }

    }
}