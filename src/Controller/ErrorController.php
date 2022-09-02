<?php

namespace App\Controller;

use App\Core\Controller;

class ErrorController extends Controller
{

    public function error404()
    {
        $location = 'Error 404';

        return $this->render('404.html.twig', [
            'location' => $location
        ]);
    }
}
