<?php

namespace App\Controller;

use App\Repository\AnnonceRepository;
use App\Repository\CommentRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AnnonceController extends AbstractController
{
    #[Route('/home', name: "app_annonce_list")]
    public function getAnnonceList(AnnonceRepository $annonceRepository) 
    {

        $annonce = $annonceRepository->findAll();

        return $this->render('annonce/annonce.html.twig', ['annonce' => $annonce]);
    }
    #[Route('/annonce/{id}', name: "app_annonce_by_id")]
    public function getAnnonceById($id, AnnonceRepository $annonceRepository, CommentRepository $commentRepository)
    {

        $annonce = $annonceRepository->findOneBy(["id" => $id]);
        $seller = $annonceRepository->getSeller($id);
        $comments = $commentRepository->getComments($id);

        return $this->render('annonce/annonce.html.twig', ['annonce' => $annonce, 'comments' => $comments, 'seller' => $seller]);
    }


}