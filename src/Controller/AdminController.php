<?php

namespace App\Controller;

use App\Core\Controller;

class AdminController extends Controller
{

    public function admin()
    {
        // $userRepository = $this->entityManager->getRepository(User::class);

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
}
