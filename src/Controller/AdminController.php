<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Core\Request;
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

    public function userAdmin($params)
    {
        $user = $this->entityManager->getRepository(User::class)->find($params['id']);

        $posts = $this->entityManager->getRepository(Post::class)->findBy(['authorId' => $user->getId()]);

        $comments = $this->entityManager->getRepository(Comment::class)->findBy(['authorId' => $user->getId()]);

        $location = 'User admin';

        return $this->render('admin/user-admin.html.twig', [
            'location'  => $location,
            'user'      => $user,
            'posts'     => $posts,
            'comments'  => $comments
        ]);
    }

    public function editUserAdmin($params)
    {
        $request = new Request();
        $user = $this->entityManager->getRepository(User::class)->find($params['id']);

        $user->setRole($request->getRequest('role'));

        if($request->getRequest('status')){
            $user->setStatus(1);
        }else{
            $user->setStatus(0);
        }

        $this->entityManager->update($user);


        return $this->redirectRoute('users_admin', ['id' => $params['id']]);
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
