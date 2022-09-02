<?php

namespace App\Controller;

use DateTime;
use App\Entity\Post;
use App\Entity\User;
use App\Core\Controller;
use App\Repository\UserRepository;

class PostController extends Controller
{

    public function index()
    {
        
        $location = 'posts list';

        $posts = $this->entityManager->getRepository(Post::class)->findAll();

        return $this->render('post/index.html.twig', [
            'location' => $location,
            'posts' => $posts
        ]);
    }

    public function edit($params)
    {
        $location = 'edit posts '.$params['id'];

        return $this->render('post/index.html.twig', [
            'location' => $location
        ]);
    }

    public function postsAdmin()
    {
        $location = 'posts list';

        $posts = $this->entityManager->getRepository(Post::class)->findAll();

        return $this->render('post/posts-admin.html.twig', [
            'location' => $location,
            'posts' => $posts
        ]);
    }

    public function newPost()
    {
        $location = 'posts new';

        return $this->render('post/new-post.html.twig', [
            'location' => $location,
        ]);
    }
    
}
