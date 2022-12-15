<?php

namespace App\Controller;

use DateTime;
use App\Entity\Post;
use App\Entity\User;
use App\Core\Request;
use App\Entity\Comment;
use App\Forms\PostForm;
use App\Core\Controller;
use App\Core\JsonContent;

class AdminController extends Controller
{
    public function admin()
    {
        $location = 'admin';

        return $this->render('admin/index.html.twig', [
            'location' => $location
        ]);
    }

    public function postsAdmin()
    {
        $location = 'posts list';

        $posts = $this->entityManager->getRepository(Post::class)->findAll();

        return $this->render('admin/admin-posts.html.twig', [
            'location' => $location,
            'posts' => $posts
        ]);
    }

    public function adminNewPost()
    {
        $location = 'posts new';

        $form = new PostForm(new Post());

        $form->handleRequest(new Request());
        if ($form->isSubmited() && $form->isValid()) {
            $post = $form->getData();
            $dateNow = new DateTime();

            $post->setCreatedAt($dateNow->format('Y-m-d H:i:s'))
            ->setUpdatedAt($dateNow->format('Y-m-d H:i:s'))
            ->setValidatedAt('0000-00-00 00:00:00')
            ->setAuthorId($this->getUser()->getId());

            if ($post->getStatus() == 1) {
                $post->setValidatedAt($dateNow->format('Y-m-d H:i:s'));
            }

            $this->entityManager->insert($post);

            return $this->redirectRoute('admin_edit_post', ['id' => $post->getId()]);
        }
        return $this->render('admin/admin-new-post.html.twig', [
            'location' => $location,
        ]);
    }

    public function adminEditPost($params)
    {
        $location = 'edit post ' . $params['id'];

        $post = $this->entityManager->getRepository(Post::class)->find($params['id']);
        $form = new PostForm($post);
        $form->handleRequest(new Request());

        if ($form->isSubmited() && $form->isValid()) {
            $post = $form->getData();

            $dateNow = new DateTime();

            $post->setUpdatedAt($dateNow->format('Y-m-d H:i:s'));

            $this->entityManager->update($post);

            if ($this->getUser()->getRole() == 'admin') {
                $this->redirectRoute('posts_admin');
            } else {
                $this->redirectRoute('posts_user');
            }
        }

        return $this->render('admin/admin-edit-post.html.twig', [
            'location' => $location,
            'post' => $post,
        ]);
    }

    public function adminToggleStatus($params)
    {
        $post = $this->entityManager->getRepository(Post::class)->find($params['id']);

        $date = new DateTime();

        if ($post->getStatus() == 1) {
            $post->setStatus(2);
            $post->setValidatedAt($date->format('Y-m-d H:i:s'))
            ->setUpdatedAt($date->format('Y-m-d H:i:s'));
        } else {
            $post->setStatus(1);
            $post->setUpdatedAt($date->format('Y-m-d H:i:s'));
        }

        $this->entityManager->update($post);

        return $this->redirectRoute('posts_admin');
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

        if ($this->getUser()->getId() == $user->getId()) {
            $this->session->setSession('role', $user->getRole('role'));
        }

        if ($request->getRequest('status')) {
            $user->setStatus(1);
        } else {
            $user->setStatus(0);
        }
        $now = new \DateTime();
        $user->setUpdatedAt($now->format('Y-m-d H:i:s'));
        $this->entityManager->update($user);


        return $this->redirectRoute('user_admin', ['id' => $params['id']]);
    }

    public function removeUserAdmin($params)
    {
        $user = $this->entityManager->getRepository(User::class)->find($params['id']);

        $this->entityManager->remove($user);

        return $this->redirectRoute('users_admin');
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
