<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/se-connecter', name: 'app_user')]
    public function login(): Response
    {
        return $this->render('user/login.html.twig');
    }


    #[Route('/inscription', name: 'app_user')]
    public function subscribe(): Response
    {
        return $this->render('user/subscribe.html.twig');
    }
}
