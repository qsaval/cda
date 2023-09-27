<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Service\MailService;
use App\Entity\DetailCommande;
use App\Service\PanierService;
use App\Repository\BdRepository;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanierController extends AbstractController
{
    #[Route('/mon-panier', name: 'app_panier')]
    public function index(PanierService $panierService, CategorieRepository $categorieRepository, BdRepository $bdRepository, Request $request): Response
    {
        $recherche = $request->request->get('search');
        if($recherche != null){
            if($categorieRepository->findOneBy(['nomCategorie' => $recherche])){ 
                $categorie = $categorieRepository->findOneBy(['nomCategorie' => $recherche]);
                return $this->redirectToRoute('app_categorie', ['id' => $categorie->getId()]);
            }

            if($bdRepository->findOneBy(['titre' => $recherche])){ 
                $bd = $bdRepository->findOneBy(['titre' => $recherche]);
                return $this->redirectToRoute('app_bd', ['id' => $bd->getId()]);
            }
        }
        return $this->render('panier/index.html.twig', [
            'panier' => $panierService->getTotal(),
            'routes' => '/mon-panier'
        ]);
    }

    #[Route('/mon-panier/valide', name: 'app_panier_valide')]
    public function valide(Request $request, BdRepository $repo, EntityManagerInterface $em, MailService $mailService): Response
    {
        $session = $request->getSession();
        $panier = $session->get('panier', []);

        $commande = new Commande();
        $total = 0;
        foreach($panier as $id => $quantite)
        {
            $bd = $repo->find($id);
            
            $detail = new DetailCommande();
            $detail->setBd($bd)
                ->setNbCommander($quantite);
            $em->persist($detail);

            $bd->setStock($bd->getStock() - $quantite);
            
            $commande->addDetailCommande($detail);

            $total = $total + ($bd->getPrix() * $quantite);
        }
        
        $commande->setMontantCommande($total)
            ->setEtatCommande(0)
            ->setDateCommande(new \DateTimeImmutable())
            ->setUser($this->getUser());
        $em->persist($commande);

        $em->flush();

        $mailService->sendValide(
            'serviceClient@thedistrict.com',
            'Commande validée',
            'emails/valide.html.twig',
            $this->getUser()->getEmail()
        );

        return $this->redirectToRoute('app_home');
    }

    #[Route('/mon-panier/add/{id<\d+>}', name: 'app_panier_add')]
    public function addToRoute(PanierService $panierService, int $id): Response
    {
        $panierService->ajouterAuPanier($id);
        return $this->redirectToRoute('app_panier');
    }

    #[Route('/mon-panier/remove/{id<\d+>}', name: 'app_panier_remove')]
    public function removeToCart(PanierService $panierService, int $id): Response
    {
        $panierService->retireDuPanier($id);
        return $this->redirectToRoute('app_panier');
    }

    #[Route('/mon-panier/decrease/{id<\d+>}', name: 'app_panier_decrease')]
    public function decrease(PanierService $panierService, int $id): RedirectResponse
    {
        $panierService->reduire($id);
        return $this->redirectToRoute('app_panier');
    }

    #[Route('/mon-panier/removeAll', name: 'app_cart_removeAll')]
    public function removeAll(PanierService $panierService): Response
    {
        $panierService->supprimerToutPanier();
        return $this->redirectToRoute('app_panier');
    }
}