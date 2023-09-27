<?php

namespace App\Controller;

use App\Entity\Bd;
use App\Repository\BdRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BdController extends AbstractController
{
    #[Route('/bd/{id}', name: 'app_bd')]
    public function index(Bd $bd, CategorieRepository $categorieRepository, Request $request, BdRepository $bdRepository): Response
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
        return $this->render('bd/index.html.twig', [
            'bd' => $bd,
            'routes' => '/bd/'.$bd->getId()
        ]);
    }
}
