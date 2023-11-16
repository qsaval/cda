<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\DetailCommande;
use App\Entity\Livraison;
use App\Repository\BdRepository;
use App\Service\MailService;
use App\Service\PanierService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaiementController extends AbstractController
{
    #[Route('/paiement', name: 'app_paiement')]
    public function index(Request $request, BdRepository $repo, EntityManagerInterface $em, MailService $mailService, PanierService $panierService): Response
    {
        $session = $request->getSession();
        $panier = $session->get('panier', []);
        $total = 0;
        $frais = 0;
        foreach ($panier as $id => $quantite)
        {
            $bd = $repo->find($id);
            $total = $total + ($bd->getPrix() * $quantite);
        }

        if ($this->getUser()->getType() == 'particulier'){
            $frais = $total * 0.2;
            $total = $total * 1.2;
        }

        if ($total < 80){
            $total = $total + 5;
        }

        if($request->request->get('numcart') && $request->request->get('nompro') && $request->request->get('datevalid') && $request->request->get('numsecret')){
            $commande = new Commande();
            $livraison = new Livraison();

            foreach($panier as $id => $quantite)
            {
                $bd = $repo->find($id);

                $detail = new DetailCommande();
                $detail->setBd($bd)
                    ->setNbCommander($quantite)
                    ->setPrixCommander($bd->getPrix());
                $em->persist($detail);

                $bd->setStock($bd->getStock() - $quantite);

                $commande->addDetailCommande($detail);
            }

            $livraison->setDateLivraison(new \DateTimeImmutable('+1 week'))
                ->setRetardEventuel(false);
            $em->persist($livraison);

            $commande->setMontantCommande($total)
                ->setEtatCommande(0)
                ->setDateCommande(new \DateTimeImmutable())
                ->setLivraison($livraison)
                ->setUser($this->getUser())
                ->setFacture('Facture.pdf')
                ->setAdresseFacture($this->getUser()->getAdresseFacturation())
                ->setCpFacture($this->getUser()->getCpFacturation())
                ->setVilleFacture($this->getUser()->getVilleFacturation())
                ->setNbColis(1);
            $em->persist($commande);




            $em->flush();

//        $mailService->sendValide(
//            'serviceClient@thedistrict.com',
//            'Commande validée',
//            'emails/valide.html.twig',
//            $this->getUser()->getEmail()
//        );
            $panierService->supprimerToutPanier();
            return $this->redirectToRoute('app_home');
        }


        return $this->render('paiement/index.html.twig', [
            'total' => $total
        ]);
    }
}
