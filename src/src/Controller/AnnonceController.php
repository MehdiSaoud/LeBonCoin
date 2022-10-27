<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Repository\AnnonceRepository;
use App\Repository\CommentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AnnonceController extends AbstractController
{
    #[Route('/home', name: "app_annonce_list")]
    public function getAnnonceList(AnnonceRepository $annonceRepository,Request $request) 
    {
        $search = $request->request->get('_search');
        $sort =  $annonceRepository->findOneBy(['title' => $search]);
        
        var_dump($search);
        
        if ($sort) {
            return $this->render('home/home.html.twig', ['annonce' => $sort]);
        }

        $annonce = $annonceRepository->findAll();
        return $this->render('home/home.html.twig', ['annonce' => $annonce]);
    }

    #[Route('/annonce/{id}', name: "app_annonce_by_id")]
    public function getAnnonceById($id, AnnonceRepository $annonceRepository, CommentRepository $commentRepository)
    {

        $annonce = $annonceRepository->findOneBy(["id" => $id]);
        $seller = $annonceRepository->getSeller($id);
        $comments = $commentRepository->getComments($id);

        return $this->render('annonce/annonce.html.twig', ['annonce' => $annonce, 'comments' => $comments, 'seller' => $seller, 'id' => $id]);
    }


}