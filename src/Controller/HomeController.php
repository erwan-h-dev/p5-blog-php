<?php

namespace App\Controller;

use App\Entity\User;
use App\Core\Controller;
use App\Repository\UserRepository;

class HomeController extends Controller
{
    public function __construct()
    {
    }

    /**
     * @Root="/", 
     * @Name="home_index"
     */
    public function index()
    {
        // $userRepository = $this->entityManager->getRepository(User::class);

        $location = 'home';

        return $this->render('home.html.twig', [
            'location' => $location
        ]);
    }
}
