<?php

namespace App\Controller;

use App\Repository\BdRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CategorieRepository $categorieRepository, BdRepository $bdRepository, Request $request): Response
    {
        $cat = $categorieRepository->findByExampleField();
        $bd = $bdRepository->findByExampleField();
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
        return $this->render('home/index.html.twig',[
            'cats' => $cat,
            'bds' =>$bd,
            'routes' => '/'
        ]);
    }
}
