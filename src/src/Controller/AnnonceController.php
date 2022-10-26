<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Form\CreateAnnonceType;
use App\Repository\AnnonceRepository;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnonceController extends AbstractController
{
    #[Route('/home', name: "app_annonce_list")]
    public function getAnnonceList(AnnonceRepository $annonceRepository) : Response
    {

        $annonce = $annonceRepository->findAll();

        return $this->render('home/home.html.twig', ['annonce' => $annonce]);
    }

    #[Route('/annonce/{id}', name: "app_annonce_by_id")]
    public function getAnnonceById($id, AnnonceRepository $annonceRepository, CommentRepository $commentRepository): Response
    {

        $annonce = $annonceRepository->findOneBy(["id" => $id]);
        $seller = $annonceRepository->getSeller($id);
        $comments = $commentRepository->getComments($id);

        return $this->render('annonce/annonce.html.twig', ['annonce' => $annonce, 'comments' => $comments, 'seller' => $seller, 'id' => $id]);
    }

    #[Route('creer-annonce', name: "app_annonce_create")]
    public function createAnnonce(Request $request) : Response
    {
        $annonce = new Annonce();
        $form = $this->createForm(CreateAnnonceType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->render('annonce/myAnnonce.html.twig');
        }

        return $this->render('annonce/create.html.twig', [
            'register_form' => $form->createView(),
        ]);
    }
}