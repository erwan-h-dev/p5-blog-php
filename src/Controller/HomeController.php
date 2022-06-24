<?php

namespace App\Controller;

use App\Core\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $location = 'home index';

        return $this->render('home.html.twig', [
            'location' => $location
        ]);
    }
}
