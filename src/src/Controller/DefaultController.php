<?php

namespace App\Controller;

use App\Repository\AnnonceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default')]
    public function index(AnnonceRepository $annonceRepository, Request $request): Response
    {
        $search = $request->request->get('_search');
        $sort = $annonceRepository->findOneBy(['title' => $search]);


        if ($sort) {
            return $this->render('home/home.html.twig', ['annonce' => $sort, 'home' => True]);
        }

        $annonce = $annonceRepository->findAll();

        return $this->render('home/home.html.twig', ['annonce' => $annonce, 'home' => True]);
    }
}
