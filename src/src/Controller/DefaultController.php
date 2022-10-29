<?php

namespace App\Controller;

use App\Repository\AnnonceRepository;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default')]
    public function index(AnnonceRepository $annonceRepository, TagRepository $tagRepository, Request $request): Response
    {
        $tags = $tagRepository->findAll();
        $search = $request->request->get('_search');
        $searchRadio = $request->request->get('_radioSearch');

        $sortCategory =  $annonceRepository->findOneBy(['tags' => $searchRadio]);

        if ($search) {
            $annonce = $annonceRepository->searchAnnonce($search);
            return $this->render('home/home.html.twig', ['annonce' => $annonce, 'tags' => $tags, 'home' => True]);
        }

        if ($sortCategory) {
            return $this->render('home/home.html.twig', ['annonce' => $sortCategory, 'tags' => $tags, 'home' => True]);
        }
        $annonce = $annonceRepository->getAllAnnonces();
        return $this->render('home/home.html.twig', ['annonce' => $annonce, 'tags' => $tags, 'home' => True]);
    }
}
