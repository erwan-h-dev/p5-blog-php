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
            'status' => 1,
        ]);
        // var_dump($posts);
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

        $form = new PostForm(new Post());

        $form->handleRequest(new Request());
        if ($form->isSubmited() && $form->isValid()) {

            $post = $form->getData();
            $dateNow = new DateTime();

            $post->setCreatedAt($dateNow->format('Y-m-d H:i:s'))
            ->setUpdatedAt($dateNow->format('Y-m-d H:i:s'))
            ->setAuthorId($this->getUser()->getId());

            $this->entityManager->insert($post);

            return $this->redirectRoute('edit_post', ['id' => $post->getId()]);
        }
        return $this->render('post/new-post.html.twig', [
            'location' => $location,
        ]);
    }

    public function editPost($params)
    {
        
        $location = 'edit posts '.$params['id'];

        $post = $this->entityManager->getRepository(Post::class)->find($params['id']);
        $form = new PostForm($post);
        $form->handleRequest(new Request());
        
        if ($form->isSubmited() && $form->isValid()){
            
            $post = $form->getData();
            
            $dateNow = new DateTime();

            $post->setUpdatedAt($dateNow->format('Y-m-d H:i:s'));
            
            $this->entityManager->update($post);

            if($this->getUser()->getRole() == 'admin') {
                $this->redirectRoute('posts_admin');
            } else {
                $this->redirectRoute('posts_user');
            }
        }

        return $this->render('post/edit-post.html.twig', [
            'location' => $location,
            'post' => $post,
        ]);
    }

    public function removePost($params)
    {
        $post = $this->entityManager->getRepository(Post::class)->find($params['id']);
        
        $this->entityManager->remove($post);

        if($this->getUser()->getRole() == 'admin') {
            $this->redirectRoute('posts_admin');
        } else {
            $this->redirectRoute('posts_user');
        }
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
