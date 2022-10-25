<?php

namespace App\Controller;

use App\Repository\AnnonceRepository;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnonceController extends AbstractController
{
    #[Route('/annonce/{id}', name: "app_annonce_by_id")]
    public function getAnnonceById($id, AnnonceRepository $annonceRepository, CommentRepository $commentRepository)
    {

        $annonce = $annonceRepository->findOneBy(["id" => $id]);

        return $this->render('annonce/annonce.html.twig', ['annonce' => $annonce]);
    }

}