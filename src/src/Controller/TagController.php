<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TagController extends AbstractController
{
    #[Route('/admin-ajout-tag', name: 'app_ajout_tag_page', methods: ["GET"])]
    public function addTagPage(): Response
    {
        return $this->render('tag/ajout-tag.html.twig', ['test' => null]);
    }

    #[Route('/admin-ajout-tag', name: 'app_ajout_tag', methods: ["POST"])]
    public function addComment(Request $request, EntityManagerInterface $entityManager, TagRepository $tagRepository): Response
    {
        $requestTag = $request->request->get("tag_name");
        $newTag = (new Tag())
            ->setTag($requestTag);

        $tagExist = $tagRepository->findOneBy(["tag" => $requestTag]);

        if(!$tagExist){
            $entityManager->persist($newTag);
            $entityManager->flush();
            $test = 'Tag ajouté !';
        }else{
            $test = 'Le tag existe déjà.';
        }

        return $this->render('tag/ajout-tag.html.twig', ['test' => $test]);
    }
}
