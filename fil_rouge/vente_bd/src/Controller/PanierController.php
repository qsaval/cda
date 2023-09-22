<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Service\CartService;
use App\Service\MailService;
use App\Entity\DetailCommande;
use App\Repository\BdRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanierController extends AbstractController
{
    #[Route('/mon-panier', name: 'app_cart')]
    public function index(CartService $cartService): Response
    {
        return $this->render('panier/index.html.twig', [
            'cart' => $cartService->getTotal()
        ]);
    }

    #[Route('/mon-panier/valide', name: 'app_cart_valide')]
    public function valide(Request $request, BdRepository $repo, EntityManagerInterface $em, MailService $mailService): Response
    {
        $session = $request->getSession();
        $panier = $session->get('cart', []);

        $commande = new Commande();
        $total = 0;
        foreach($panier as $id => $quantite)
        {
            $bd = $repo->find($id);
            
            $detail = new DetailCommande();
            $detail->setBd($bd)
                ->setNbCommander($quantite);
            $em->persist($detail);

            
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

    #[Route('/mon-panier/add/{id<\d+>}', name: 'app_cart_add')]
    public function addToRoute(CartService $cartService, int $id): Response
    {
        $cartService->addToCart($id);
        return $this->redirectToRoute('app_cart');
    }

    #[Route('/mon-panier/remove/{id<\d+>}', name: 'app_cart_remove')]
    public function removeToCart(CartService $cartService, int $id): Response
    {
        $cartService->removeToCart($id);
        return $this->redirectToRoute('app_cart');
    }

    #[Route('/mon-panier/decrease/{id<\d+>}', name: 'app_cart_decrease')]

    public function decrease(CartService $cartService, int $id): RedirectResponse
    {
        $cartService->decrease($id);
        return $this->redirectToRoute('app_cart');
    }

    #[Route('/mon-panier/removeAll', name: 'app_cart_removeAll')]
    public function removeAll(CartService $carteService): Response
    {
        $carteService->removeCartAll();
        return $this->redirectToRoute('app_cart');
    }
}