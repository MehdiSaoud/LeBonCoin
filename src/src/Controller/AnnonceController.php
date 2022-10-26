<?php

namespace App\Controller;

use App\Repository\AnnonceRepository;
use Doctrine\ORM\Query\AST\Functions\LengthFunction;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AnnonceController extends AbstractController
{
    #[Route('/home', name: "app_annonce_by_id")]
    public function getAnnonceById(AnnonceRepository $annonceRepository) 
    {

        $annonce = $annonceRepository->findAll();
        $length = count($annonce);

        return $this->render('home/home.html.twig', ['annonce' => $annonce,'length' => $length]);
    }

}