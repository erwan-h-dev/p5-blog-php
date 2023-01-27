<?php

namespace App\Controller;

use App\Core\Mail;
use App\Core\Request;
use App\Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $location = 'home';

        $request = new Request();

        $result = null;

        if($request->request() != null) {
            $mail = new Mail();
            $mail->setSubject($request->getRequest('object'))
                ->setFrom([$request->getRequest('email') => $request->getRequest('firstname')." ".$request->getRequest('lastname')])
                ->setTo(["erwan.h.dev@gmail.com" => "Erwan Dev"])
                ->setBody($request->getRequest('message'))
            ;
    
            $result = $mail->send();
        }

        return $this->render('general/home.html.twig', [
            'location' => $location,
            'result' => $result
        ]);
    }
}
