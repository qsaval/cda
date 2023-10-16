<?php

namespace App\Controller;

use App\Repository\TransporteurRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivraisonController extends AbstractController
{
    #[Route('/livraison', name: 'app_livraison')]
    public function index(TransporteurRepository $transporteurRepository ,Request $request): Response
    {
        $transporteur = $transporteurRepository->findAll();

        if ($request->request->get('11')){
            $frais = $transporteur[0]->getFraisLivraison();
            dd($frais);
            return $this->redirectToRoute('app_paiement', ['frais' => $frais]);

        }
        if ($request->request->get('12')){
            $frais = $transporteur[0]->getFraisLivraisonRapide();
            dd($frais);
            return $this->redirectToRoute('app_paiement', ['frais' => $frais]);
        }
        if ($request->request->get('21')){
            $frais = $transporteur[1]->getFraisLivraison();
            dd($frais);
            return $this->redirectToRoute('app_paiement', ['frais' => $frais]);
        }
        if ($request->request->get('22')){
            $frais = $transporteur[1]->getFraisLivraisonRapide();
            dd($frais);
            return $this->redirectToRoute('app_paiement', ['frais' => $frais]);
        }


        return $this->render('livraison/index.html.twig', [
            'transporteurs' => $transporteur,
        ]);
    }
}
