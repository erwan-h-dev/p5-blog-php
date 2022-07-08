<?php

namespace App\Controller;

use App\Entity\User;
use App\Core\Controller;
use App\Repository\UserRepository;

class SecurityController extends Controller
{
    public function __construct()
    {
    }

    public function login()
    {
        if($_SESSION['role'] != 'anonymous'){
            header('Location: /');
        }
        $userRepository = $this->entityManager->getRepository(User::class);

        if (count($_POST) > 0) {
            $user = $userRepository->findOneBy(['email' => $_POST['login']['email']]);
            if ($user != null) {

                if (password_verify($_POST['login']['password'],  $user->getPassword())) {

                    $_SESSION['user'] = $user->getUserName();
                    $_SESSION['role'] = $user->getRole();
                    $_SESSION['id'] = $user->getId();

                    header('Location: /');
                }
            }
        }

        $location = 'login';

        return $this->render('security/login.html.twig', [
            'location' => $location
        ]);
    }

    public function register()
    {
        $userRepository = $this->entityManager->getRepository(User::class);

        if (count($_POST) > 0) {
            
            $user = $userRepository->findOneBy(['email' => $_POST['register']['email']]);

            if(preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $_POST['register']['password'])){
                if($_POST['register']['password'] === $_POST['register']["password_confirm"]){
                    if (!$user){

                        $user = new User();
        
                        $date = new \DateTime();
            
                        $user->setUserName($_POST['register']['userName'])
                            ->setFirstName($_POST['register']['firstName'])
                            ->setLastName($_POST['register']['lastName'])
                            ->setEmail($_POST['register']['email'])
                            ->setPassword(password_hash($_POST['register']['password'], PASSWORD_BCRYPT))
                            ->setCreatedAt($date->format('Y-m-d H:i:s'))
                            ->setUpdatedAt($date->format('Y-m-d H:i:s'))
                            ->setRole('user');
            
                        $this->entityManager->persist($user);
                        
                        return $this->render('security/login.html.twig', []);
                    }else{
                        return $this->render('security/register.html.twig', [
                            'error' => [
                                'email' => 'Email already exists'
                            ]
                        ]);
                    }
                }else{
                    return $this->render('security/register.html.twig', [
                        'error' => [
                            'password' => 'Your passwords do not match'
                        ]
                    ]);
                }
            }else{
                return $this->render('security/register.html.twig', [
                    'error' => [
                        'password' => 'Your password must be at least 8 characters long or no contain numbers'
                    ]
                ]);
            }
        }

        return $this->render('security/register.html.twig', []);
    }

    public function logout()
    {
        session_destroy();

        header('Location: /');
    }
}
