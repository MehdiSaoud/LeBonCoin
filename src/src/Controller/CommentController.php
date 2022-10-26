<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Repository\AnnonceRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CommentController extends AbstractController
{
    #[Route('/annonce/{id}/comment', name: 'app_comment_add', methods: ["POST"])]
    public function addComment($id, Request $request, EntityManagerInterface $entityManager, AnnonceRepository $annonceRepository, UserRepository $userRepository): Response
    {
        $user_email = $this->getUser()->getUserIdentifier();

        $newComment = (new Comment())
            ->setQuestion($request->request->get("question"))
            ->setIdUser($userRepository->findOneBy(["email"=> $user_email]))
            ->setIdAnnonce($annonceRepository->findOneBy(["id" => $id]))
            ->setCreationDate(new \DateTimeImmutable());

        $entityManager->persist($newComment);
        $entityManager->flush();

        return $this->redirectToRoute('app_annonce_by_id', array("id" => $id));
    }
}
