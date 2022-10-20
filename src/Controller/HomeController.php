<?php

namespace App\Controller;

use App\Entity\User;
use App\Core\Controller;
use App\Repository\UserRepository;

class HomeController extends Controller
{

    public function index()
    {
        $location = 'home';

        return $this->render('general/home.html.twig', [
            'location' => $location
        ]);
    }

    public function contact()
    {
        $location = 'Contact';

        return $this->render('general/contact.html.twig', [
            'location' => $location
        ]);
    }
}
