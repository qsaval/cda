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
    public function index(Categorie $categorie, CategorieRepository $categorieRepository): Response
    {
        $categories = $categorieRepository->findByExampleField1($categorie->getId());
        return $this->render('categorie/index.html.twig', [
            'cats' => $categories,
        ]);
    }

    #[Route('/categorie/bd/{id}', name: 'app_list_bd')]
    public function bd(Categorie $categorie, BdRepository $bdRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $bds = $paginator->paginate(
            $bdRepository->findBy(['categorie' => $categorie->getId()]),
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('categorie/bd.html.twig', [
            'bds' => $bds,
            'cat' => $categorie,
        ]);
    }
}
