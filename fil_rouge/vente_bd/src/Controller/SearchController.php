<?php

namespace App\Controller;

use App\Repository\BdRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function index(Request $request, BdRepository $repo, PaginatorInterface $paginator): Response
    {
        $query = $request->request->get('search');
        $bd =null;
        if($query) {
            $bd = $repo->findBdByName($query);
        }

        return $this->render('search/index.html.twig', [
            'bds' => $bd
        ]);
    }
}
