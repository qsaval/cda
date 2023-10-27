<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\User;
use App\Form\UserType;
use App\Form\UserPasswordType;
use App\Repository\CommandeRepository;
use App\Repository\DetailCommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ProfilController extends AbstractController
{
    #[Route('/profil/{id}', name: 'app_profile')]
    #[Security('user === users')]
    public function index(User $users): Response
    {
        return $this->render('profil/index.html.twig', [
            'user' => $users,
        ]);
    }

    #[Route('/profil/modification/{id}', name: 'app_profil_modif')]
    #[Security('user === users')]
    public function modif(User $users, Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hasher): Response
    {
        $form = $this->createForm(UserType::class, $users);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $users = $form->getData();
            $manager->persist($users);
            $manager->flush();

            return $this->redirectToRoute('app_profile', ['id' => $users->getId()]);
        }

        return $this->render('profil/modification.html.twig', [
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

        return $this->render('profil/password.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/commande/{id}', name: 'app_commande')]
    #[Security('user === users')]
    public function commande(User $users, CommandeRepository $commandeRepository): Response
    {
        $commande = $commandeRepository->findByDESC(['user' => $users->getId()]);
        return $this->render('profil/commande.html.twig', [
            'commandes' => $commande,
        ]);
    }
    #[Route('/commande/{users}/{commande}', name: 'app_commande_detail')]
    #[Security('user === users')]
    public function commandeDetail(User $users, Commande $commande, DetailCommandeRepository $detailCommandeRepository): Response
    {
        $detail = $detailCommandeRepository->findBy(['commande' => $commande->getId()]);
        return $this->render('profil/detail.html.twig', [
            'details' => $detail,
        ]);
    }

    #[Route('/commande/annulee/{users}/{commande}', name: 'app_commande_annulee')]
    #[Security('user === users')]
    public function annuler(User $users, Commande $commande, EntityManagerInterface $em): Response
    {
        $commande->setEtatCommande(4);
        $em->persist($commande);
        $em->flush();
        return $this->redirectToRoute('app_commande', ['id' => $users->getId()]);
    }
}
