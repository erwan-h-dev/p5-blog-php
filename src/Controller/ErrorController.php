<?php

namespace App\Controller;

use App\Core\Controller;

class ErrorController extends Controller
{

    public function index()
    {
        $location = 'Error 404';

        return $this->render('home.html.twig', [
            'location' => $location
        ]);
    }
}
