<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\BdRepository;
use App\Repository\CategorieRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController
{
    #[Route('/categorie/{id}', name: 'app_categorie')]
    public function index(Categorie $categorie, CategorieRepository $categorieRepository, Request $request, BdRepository $bdRepository): Response
    {
        $categories = $categorieRepository->findByExampleField1($categorie->getId());
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
        return $this->render('categorie/index.html.twig', [
            'cats' => $categories,
            'routes' => '/categorie/' . $categorie->getId()
        ]);
    }

    #[Route('/categorie/bd/{id}', name: 'app_list_bd')]
    public function bd(Categorie $categorie, BdRepository $bdRepository, CategorieRepository $categorieRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $bds = $paginator->paginate(
            $bdRepository->findBy(['categorie' => $categorie->getId()]),
            $request->query->getInt('page', 1),
            6
        );
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

        return $this->render('categorie/bd.html.twig', [
            'bds' => $bds,
            'cat' => $categorie,
            'routes' => '/categorie/bd/' . $categorie->getId()
        ]);
    }
}
