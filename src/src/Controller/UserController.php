<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterFormType;
use Doctrine\DBAL\Types\TextType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/se-connecter', name: 'app_user')]
    public function login(): Response
    {
        return $this->render('user/login.html.twig');
    }


    #[Route('/inscription', name: 'app_user')]
    public function register(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();

        $form = $this->createForm(RegisterFormType::class, $user);
        $form->handleRequest($request);

        //$data = $form->getData();
        //print_r($data);

        //$pass_hashed = password_hash($user->getPassword(),1);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setAccountCreationDate(new \DateTime());
            $user->setRole('ROLE_USER');
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->render('user/ok.html.twig', [
                'lastname' => $user->getLastname(),
                'firstname' => $user->getFirstname()
            ]);
        }

        return $this->render('user/register.html.twig', [
            'register_form' => $form->createView()
        ]);
    }
}
