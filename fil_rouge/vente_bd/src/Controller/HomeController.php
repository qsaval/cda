<?php

namespace App\Controller;

use App\Repository\BdRepository;
use App\Repository\CategorieRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CategorieRepository $categorieRepository, BdRepository $bdRepository, Request $request): Response
    {
        $catSimple = $categorieRepository->findOneBy(['id'=> 1]);
        $cat = $categorieRepository->findByExampleField();
        $bd = $bdRepository->findByExampleField();
       
        return $this->render('home/index.html.twig',[
            'cats' => $cat,
            'bds' =>$bd,
            'catsimple' => $catSimple,
        ]);
    }

    #[Route('/bd', name: 'app_tout_bd')]
    public function bd(BdRepository $bdRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $bd = $paginator->paginate(
            $bdRepository->findAll(),
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('home/bd.html.twig',[
            'bds' =>$bd,
        ]);
    }
}
