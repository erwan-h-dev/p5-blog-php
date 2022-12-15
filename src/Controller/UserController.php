<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Core\Request;
use App\Entity\Follow;
use App\Entity\Comment;
use App\Forms\UserForm;
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

        $posts = $postRepository->findBy([
            'authorId' => $user->getId(),
            'status' => 2
        ]);

        return $this->render('user/user.html.twig', [
            'location'      => $location,
            'user'          => $user,
            'posts'         => $posts,
            'comments'      => $comments,
            'followers'     => $followers,
            'followings'    => $followings,
        ]);
    }

    public function editUser($params)
    {
        $location = 'Edit User';

        $userRepository = $this->entityManager->getRepository(User::class);
        $user = $userRepository->find($this->getUser()->getId());

        if ($this->getUser()->getRole() == 'admin') {
            $user = $userRepository->find($params['id']);
        } elseif ($this->getUser()->getId() != $params['id']) {
            $this->redirectRoute('edit_user', ['id' => $this->getUser()->getId()]);
        }

        return $this->render('user/edit-user.html.twig', [
            'location' => $location,
            'user' => $user
        ]);
    }

    public function editUserData($params)
    {
        $request = new Request();
        $userRepository = $this->entityManager->getRepository(User::class);
        $user = $userRepository->find($params['id']);

        $user->setUserName($request->getRequest('userName'))
            ->setFirstName($request->getRequest('firstName'))
            ->setLastName($request->getRequest('lastName'))
            ->setTwitter($request->getRequest('twitter'))
            ->setFacebook($request->getRequest('facebook'))
            ->setInstagram($request->getRequest('instagram'))
            ->setLinkedin($request->getRequest('linkedin'))
        ;

        $this->entityManager->update($user);

        return new JsonContent(['status' => 'success']);
    }

    public function editUserPassword($params)
    {
        $request = new Request();

        $userRepository = $this->entityManager->getRepository(User::class);
        $user = $userRepository->find($params['id']);

        $oldPassword = $request->getRequest('oldPassword');
        $newPassword = $request->getRequest('newPassword');
        $confirmPassword = $request->getRequest('confirmPassword');

        if ($newPassword == $confirmPassword) {
            if (password_verify($oldPassword, $user->getPassword())) {
                $user->setPassword(password_hash($newPassword, PASSWORD_BCRYPT));

                $this->entityManager->update($user);

                $response = [
                    "status" => "success",
                    'oldPassword' => "",
                    "newPassword" => "",
                    "confirmPassword" => "",
                ];
            } else {
                $response = [
                    "status" => "error",
                    'oldPassword' => "Wrong password",
                    "newPassword" => "",
                    "confirmPassword" => "",
                ];
            }
        } else {
            $response = [
                "status" => "error",
                "newPassword" => "New password and confirm password are not the same",
                "oldPassword" => "",
                "confirmPassword" => "",
            ];
        }

        return new JsonContent($response);
    }

    public function editUserProfilePicture($params)
    {
        $requete = new Request();

        $userRepository = $this->entityManager->getRepository(User::class);

        $user = $userRepository->find($params['id']);

        $user->setProfilePicture($requete->getRequest('pathFile'));

        $this->entityManager->update($user);

        return new JsonContent(['status' => 'ok']);
    }

    public function followUser($params)
    {
        $followRppository = $this->entityManager->getRepository(Follow::class);

        $follow = $followRppository->findBy(['follower' => $this->getUser()->getId(), 'following' => $params['id']]);
        if (!empty($follow)) {
            $this->entityManager->remove($follow[0]);

            return new JsonContent(['status' => 'unfollow']);
        } else {
            $follow = new Follow();
            $follow->setFollower($this->GetUser()->getId())
                ->setFollowing($params['id']);
            $this->entityManager->insert($follow);

            return new JsonContent(['status' => 'follow']);
        }
    }
}
