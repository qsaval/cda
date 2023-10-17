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
        $catSimple = $categorieRepository->findOneBy(['id'=> 1]);
        $cat = $categorieRepository->findByExampleField();
        $bd = $bdRepository->findByExampleField();
       
        return $this->render('home/index.html.twig',[
            'cats' => $cat,
            'bds' =>$bd,
            'catsimple' => $catSimple,
        ]);
    }
}
