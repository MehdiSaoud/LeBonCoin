<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\Tag;
use App\Entity\User;
use App\Form\CreateAnnonceType;
use App\Repository\AnnonceRepository;
use App\Repository\CommentRepository;
use App\Repository\TagRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnonceController extends AbstractController
{
    #[Route('/home', name: "app_annonce_list")]
    public function getAnnonceList(AnnonceRepository $annonceRepository,TagRepository $tagRepository,Request $request) 
{
    $search = $request->request->get('_search');
    $searchRadio = $request->request->get('_radioSearch');

    $sort =  $annonceRepository->findOneBy(['title' => $search]);
    $sortCategory =  $annonceRepository->findOneBy(['tags' => $searchRadio]);
        
    if ($sort) {
        return $this->render('home/home.html.twig', ['annonce' => $sort]);
    }

    if ($sortCategory) {
        return $this->render('home/home.html.twig', ['annonce' => $sortCategory]);
    }
    $tags = $tagRepository->findAll();
    $annonce = $annonceRepository->findAll();
    return $this->render('home/home.html.twig', ['annonce' => $annonce,'tags' => $tags]);
    
    
 
    
}
    #[Route('/annonce/{id}', name: "app_annonce_by_id")]
    public function getAnnonceById($id, AnnonceRepository $annonceRepository, CommentRepository $commentRepository): Response
    {

        $annonce = $annonceRepository->findOneBy(["id" => $id]);
        $seller = $annonceRepository->getSeller($id);
        $comments = $commentRepository->getComments($id);

        return $this->render('annonce/annonce.html.twig', ['annonce' => $annonce, 'comments' => $comments, 'seller' => $seller[0], 'id' => $id]);
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