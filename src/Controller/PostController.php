<?php

namespace App\Controller;

use Error;
use DateTime;
use App\Core\File;
use App\Entity\Post;
use App\Core\Request;
use App\Forms\PostForm;
use App\Core\Controller;
use App\Core\JsonContent;

class PostController extends Controller
{

    public function index()
    {
        $location = 'posts list';

        $posts = $this->entityManager->getRepository(Post::class)->findBy([
            'status' => 2,
        ]);

        return $this->render('post/index.html.twig', [
            'location' => $location,
            'posts' => $posts
        ]);
    }

    public function post($params)
    {
        $location = 'post';

        $post = $this->entityManager->getRepository(Post::class)->find($params['id']);
        $comments = $this->entityManager->getRepository(Comment::class)->findBy([
            'postId' => $post->getId(),
            'status' => 1
        ]);
        
        return $this->render('post/show.html.twig', [
            'location' => $location,
            'post' => $post,
            'comments' => $comments
        ]);
    }

    public function removePost($params)
    {
        $post = $this->entityManager->getRepository(Post::class)->find($params['id']);

        if($post->getAuthorId() == $this->getUser()->getId() || $this->getUser()->getRole() == 'admin') {
            $this->entityManager->remove($post);
        } else {
            throw new Error('You are not allowed to delete this post');
        }

        return new JsonContent(['success' => true]);
    }

    public function userPosts($params)
    {
        $location = 'posts list';

        if($this->getUser()->getRole() == 'admin') {
            $posts = $this->entityManager->getRepository(Post::class)->findBy([
                'authorId' => $params['id']
            ]);
        } else {
            $posts = $this->entityManager->getRepository(Post::class)->findBy([
                'authorId' => $this->getUser()->getId()
            ]);
        }

        return $this->render('post/user-posts.html.twig', [
            'location' => $location,
            'posts' => $posts
        ]);
    }

    public function userNewPost()
    {
        $location = 'post new';

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

            return $this->redirectRoute('edit_post_user', ['id' => $post->getId()]);
        }

        return $this->render('post/user-new-post.html.twig', [
            'location' => $location,
        ]);
    }

    public function UserEditPost($params)
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

            
            $this->redirectRoute('posts_user', ['id' => $this->getUser()->getId()]);
            
        }

        return $this->render('post/user-edit-post.html.twig', [
            'location' => $location,
            'post' => $post,
        ]);
    }

    public function uploadImage()
    {
        $file = new File();

        if($file->isImage()){
            try {
                $file->uploadFile();
            } catch(Error $e) {
               var_dump($e);
            }
        }
        
        return new JsonContent(['pathFile' => $file->getPathFile()]);
    }
}
