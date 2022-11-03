<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Entity\Comment;
use App\Core\Controller;

class AdminController extends Controller
{

    public function admin()
    {
        $location = 'admin';

        return $this->render('admin/index.html.twig', [
            'location' => $location
        ]);
    }
    
    public function usersAdmin()
    {
        $location = 'list Users';

        $users = $this->entityManager->getRepository(User::class)->findAll();

        return $this->render('admin/users-admin.html.twig', [
            'location' => $location,
            'users' => $users
        ]);
    }

    public function postsAdmin()
    {
        $location = 'Posts admin';

        $posts = $this->entityManager->getRepository(Post::class)->findAll();

        return $this->render('post/posts-admin.html.twig', [
            'location' => $location,
            'posts' => $posts
        ]);
    }
    
    public function commentsAdmin()
    {
        $location = 'Comments admin';

        $comments = $this->entityManager->getRepository(Comment::class)->findAll();

        return $this->render('admin/comments-admin.html.twig', [
            'location' => $location,
            'comments' => $comments
        ]);
    }
}
