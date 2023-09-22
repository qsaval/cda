<?php

namespace App\Controller;

use App\Entity\Bd;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BdController extends AbstractController
{
    #[Route('/bd/{id}', name: 'app_bd')]
    public function index(Bd $bd): Response
    {
        return $this->render('bd/index.html.twig', [
            'bd' => $bd
        ]);
    }
}
