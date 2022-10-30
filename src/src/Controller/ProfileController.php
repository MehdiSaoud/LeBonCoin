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
        $user_email = $this->getUser()->getUserIdentifier();
        $user = $userRepo->findBy(["email" => $user_email]);
        $user_id = $user[0]->getId();

        return $this->render('profile/index.html.twig', [
            'profile' => $userRepo->findOneBy(['pseudo'=>$pseudo]),
            'user_id' => $user_id
        ]);
    }
}
