<?php

namespace App\Controller;

use App\Entity\User;
use App\Core\Request;
use App\Core\Controller;
class SecurityController extends Controller
{

    public function login()
    {
        $userRepository = $this->entityManager->getRepository(User::class);
        $request = new Request();
        $error = [];

        if($this->getUser()){
            $this->redirectRoute('home');
        }

        if (empty($request->request())) {
            return $this->render('security/login.html.twig', []);
        }

        $user = $userRepository->findOneBy(['email' => $request->getRequest('email')]);

        if (!$user ) {
            $error['email'] = 'Email not found';
        }

        if(!password_verify($request->getRequest('password'), $user->getPassword())){
            $error['password'] = 'Password not found';
        }

        if (!empty($error)) {
            var_dump($error, $request->request());
            return $this->render('security/login.html.twig', ['error' => $error]);
        }
        
        $date = new \DateTime();
        $user->setLastLogin($date->format('Y-m-d H:i:s'));
        $this->entityManager->update($user);
        $this->setUser($user->getId());
        $this->redirectRoute('home');

        
    }

    public function register()
    {
        $userRepository = $this->entityManager->getRepository(User::class);
        $request = new Request();

        $error = [];

        if (empty($request->request())) {
            return $this->render('security/register.html.twig', []);
        }

        $user = $userRepository->findOneBy(['email' => $request->getRequest('email')]);

        if ($user) {
            $error['password'] = 'Email already exists';
        }
        
        if($request->getRequest('password') !== $request->getRequest('password_confirm')){
            $error['password'] = 'Your passwords do not match';
        }

        if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $request->getRequest('password'))) {
            $error['password'] = 'Your password must be at least 8 characters long or no contain numbers';
        }

        if(!empty($error)){
            var_dump($request->getRequest('password'));
            return $this->render('security/register.html.twig', [
                'error' => $error,
                'request' => $request->request()
            ]);
        }

        $user = new User();

        $date = new \DateTime();

        $user->setUserName($request->getRequest('userName'))
            ->setFirstName($request->getRequest('firstName'))
            ->setLastName($request->getRequest('lastName'))
            ->setEmail($request->getRequest('email'))
            ->setPassword(password_hash($request->getRequest('password'), PASSWORD_BCRYPT))
            ->setCreatedAt($date->format('Y-m-d H:i:s'))
            ->setUpdatedAt($date->format('Y-m-d H:i:s'))
            ->setLastLogin($date->format('Y-m-d H:i:s'))
            ->setRole('user')
        ;

        $this->entityManager->insert($user);
        
        return $this->render('security/login.html.twig', []);
    }

    public function logout()
    {
        $this->destroySession();

        $this->redirectRoute('login');
    }

    public function forgotPassword()
    {
        $request = new Request();
        $error = [];
        
        if(count($request->request()) == 0){
            return $this->render('security/forgotPassword.html.twig', [
                'error' => $error
            ]);
        }

        $userRepository = $this->entityManager->getRepository(User::class);
        $user = $userRepository->findOneBy(['email' => $request->getRequest('email')]);

        if (!$user) {
            $error['email'] = 'Email does not exist';
        }
        
        if ($request->getRequest('new-password') !== $request->getRequest('confirm-password')) {
            $error['password'] = 'Your passwords do not match';
        }

        if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $request->getRequest('new-password'))) {
            $error['password'] = 'Your passwords must be at least 8 characters long or no contain numbers';
        }

        
        if(!empty($error)){
            var_dump($request->request());
            return $this->render('security/forgotPassword.html.twig', [
                'error' => $error
            ]);
        }

        $user->setPassword(password_hash($request->getRequest('new-password'), PASSWORD_BCRYPT));

        $this->entityManager->update($user);

       
        $this->redirectRoute('login');
    }

    
}
