<?php

namespace App\Controller;

use App\Repository\BdRepository;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CategorieRepository $categorieRepository, BdRepository $bdRepository): Response
    {
        $cat = $categorieRepository->findByExampleField();
        $bd = $bdRepository->findByExampleField();
        return $this->render('home/index.html.twig',[
            'cats' => $cat,
            'bds' =>$bd
        ]);
    }
}
