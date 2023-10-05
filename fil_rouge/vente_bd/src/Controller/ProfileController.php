<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\UserPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ProfileController extends AbstractController
{
    #[Route('/profile/{id}', name: 'app_profile')]
    #[Security('user === users')]
    public function index(User $users): Response
    {
        return $this->render('profile/index.html.twig', [
            'user' => $users,
        ]);
    }

    #[Route('/profile/modification/{id}', name: 'app_profile_modif')]
    #[Security('user === users')]
    public function modif(User $users, Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hasher): Response
    {
        $form = $this->createForm(UserType::class, $users);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $users = $form->getData();
            $manager->persist($users);
            $manager->flush();

            return $this->redirectToRoute('app_profile');
        }

        return $this->render('profile/modification.html.twig', [
            'form' => $form->createView(),
            'user' => $users,
        ]);
    }

    #[Route('/password/{id}', name: 'app_password')]
    #[Security('user === users')]
    public function motDePasse(User $users, Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hasher): Response
    {
        $form = $this->createForm(UserPasswordType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            if ($hasher->isPasswordValid($users,$form->getData()->getPlainPassword())) {
                $users->setPlainPassword(
                    $form->getData()->getNewPassword()
                );

                $users->setPassword(
                    $hasher->hashPassword(
                        $users,
                        $users->getPlainPassword()
                    )
                );

                $users->setPlainPassword(null);

                $manager->persist($users);
                $manager->flush();


                return $this->redirectToRoute('app_home');
            }
        }

        return $this->render('profile/password.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
