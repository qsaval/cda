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

        return $this->render('panier/index.html.twig', [
            'panier' => $panierService->getTotal(),
        ]);
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