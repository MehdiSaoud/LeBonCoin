<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\Tag;
use App\Entity\User;
use App\Form\CreateAnnonceType;
use App\Repository\AnnonceRepository;
use App\Repository\CommentRepository;
use App\Repository\TagRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnonceController extends AbstractController
{
    #[Route('/home', name: "app_annonce_list")]
    public function getAnnonceList(AnnonceRepository $annonceRepository): Response
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

    #[Route('/creer-annonce', name: "app_annonce_create")]
    public function createAnnonce(Request $request, EntityManagerInterface $entityManager, TagRepository $tagRepository): Response
    {
        $annonce = new Annonce();
        $form = $this->createForm(CreateAnnonceType::class, $annonce);
        $form->handleRequest($request);
        $tags = $tagRepository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $annonce->setDateCreation(new \DateTimeImmutable());

            $tags = $form['tags']->getData();
            $tag_tab = [];
            foreach ($tags as $item) {
                $tag_tab[] = $item->getTag();
            }
            $annonce->setTags($tag_tab);

            $user_id = $this->getUser();
            $annonce->setIdUser($user_id);

            $entityManager->persist($annonce);
            $entityManager->flush();

            return $this->render('annonce/myAnnonce.html.twig');
        }

        return $this->render('annonce/create.html.twig', [
            'form' => $form->createView(),
            'tags' => $tags
        ]);
    }
}