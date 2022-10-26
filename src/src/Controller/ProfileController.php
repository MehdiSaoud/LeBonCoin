<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;

class ProfileController extends AbstractController
{
    #[Route('/profile/{pseudo}', name: 'app_profile')]
    public function index($pseudo, UserRepository $userRepo): Response
    {
        return $this->render('profile/index.html.twig', [
            'profile' => $userRepo->findOneBy(['pseudo'=>$pseudo]),
        ]);
    }
}
