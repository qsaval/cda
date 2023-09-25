<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\UserPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ProfileController extends AbstractController
{
    #[Route('/profile/{id}', name: 'app_profile')]
    public function index(User $user): Response
    {
        return $this->render('profile/index.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/profile/modification/{id}', name: 'app_profile_modif')]
    public function modif(User $choosenUser, Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hasher): Response
    {
        $form = $this->createForm(UserType::class, $choosenUser);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('app_profile');
        }

        return $this->render('profile/modification.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/motdepasse/{id}', name: 'app_password')]
    public function motDePasse(User $choosenUser, Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hasher): Response
    {
        $form = $this->createForm(UserPasswordType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            if ($hasher->isPasswordValid($choosenUser,$form->getData()->getPlainPassword())) {
                $choosenUser->setPlainPassword(
                    $form->getData()->getNewPassword()
                );

                $choosenUser->setPassword(
                    $hasher->hashPassword(
                        $choosenUser,
                        $choosenUser->getPlainPassword()
                    )
                );

                $choosenUser->setPlainPassword(null);

                $manager->persist($choosenUser);
                $manager->flush();


                return $this->redirectToRoute('app_home');
            }
        }

        return $this->render('profile/password.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
