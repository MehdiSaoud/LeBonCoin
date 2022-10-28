<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class UserController extends AbstractController
{
    #[Route('/se-connecter', name: 'app_user')]
    public function login(): Response
    {
        return $this->render('user/login.html.twig');
    }


    #[Route('/inscription', name: 'app_user_register')]
    public function register(Request $request, EntityManagerInterface $entityManager, ManagerRegistry $managerRegistry, UserRepository $repository, SluggerInterface $slugger): Response
    {
        $data['error']['pseudo'] = '';
        $data['error']['email'] = '';
        $data['error']['pass'] = '';
        $user = new User();
        $form = $this->createForm(RegisterFormType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $pseudo = $form['pseudo']->getData();
            $count_this_pseudo = $repository->countByPseudo($pseudo);

            if ($count_this_pseudo == 0) {
                $email = $form['email']->getData();
                $count_this_mail = $repository->countByEmail($email);

                if ($count_this_mail == 0) {
                    $password = $form['password']->getData();
                    if ($password === $form['password_confirm']->getData()) {
                        $pass_hashed = password_hash($password, 1);

                        $user->setAccountCreationDate(new \DateTime());
                        $user->setRoles((array)'ROLE_USER');
                        $user->setPassword($pass_hashed);

                        $photo = $form->get('photos')->getData();
                        if ($photo) {
                            $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                            $safeFilename = $slugger->slug($originalFilename);
                            $newFilename = $safeFilename . '-' . uniqid() . '.' . $photo->guessExtension();
                            $photo->move($this->getParameter('user_img'), $newFilename);
                            $user->setProfilePicture($newFilename);
                        } else {
                            $user->setProfilePicture('default.jpeg');
                        }

                        $entityManager->persist($user);
                        $entityManager->flush();

                        $lastname = $user->getLastname();
                        $firstname = $user->getFirstname();
                        $data = [$lastname, $firstname];

                        return $this->redirectToRoute('app_login');
                    } else {
                        $data['error']['pass'] = 'Les mots de passe ne correspondent pas';
                    }
                } else {
                    $data['error']['email'] = 'Cette adresse mail existe déjà';
                }
            } else {
                $data['error']['pseudo'] = 'Ce pseudo existe déjà';
            }
        }

        return $this->render('user/register.html.twig', [
            'register_form' => $form->createView(),
            'data' => $data,
        ]);
    }
}
