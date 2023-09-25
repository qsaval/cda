<?php

namespace App\Service;

use App\Entity\Bd;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PanierService {

    private RequestStack $requestStack;

    private EntityManagerInterface $em;

    public function __construct(RequestStack $requestStack, EntityManagerInterface $em)
    {
        $this->requestStack = $requestStack;
        $this->em = $em;
    }

    public function ajouterAuPanier(int $id): void
    {
        $panier = $this->getSession()->get('panier', []);
        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }
        $this->getSession()->set('panier', $panier);
    }

    public function retireDuPanier(int $id)
    {
        $panier = $this->requestStack->getSession()->get('panier', []);
        unset($panier[$id]);
        return $this->getSession()->set('panier', $panier);
    }

    public function reduire(int $id)
    {
        $panier = $this->getSession()->get('panier', []);
        if ($panier[$id] > 1) {
            $panier[$id]--;
        } else {
            unset($panier[$id]);
        }
        $this->getSession()->set('panier', $panier);
    }

    public function supprimerToutPanier()
    {
        return $this->getSession()->remove('panier');
    }

    public function getTotal(): array
    {
        $panier = $this->getSession()->get('panier');
        $panierData = [];
        if ($panier) {
            foreach ($panier as $id => $quantite) {
                $bd = $this->em->getRepository(Bd::class)->findOneBy(['id' => $id]);
                if (!$bd) {
                    // Supprimer le produit puis continuer en sortant de la boucle
                }
                $panierData[] = [
                    'bd' => $bd,
                    'quantite' => $quantite
                ];
            }
        }
        return $panierData;
    }

    private function getSession(): SessionInterface
    {
        return $this->requestStack->getSession();
    }
}