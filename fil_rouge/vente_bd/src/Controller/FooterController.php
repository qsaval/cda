<?php

namespace App\Controller;


use App\Service\MailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FooterController extends AbstractController
{
    #[Route('/qui_somme_nous', name: 'app_footer')]
    public function index(): Response
    {
        return $this->render('footer/index.html.twig');
    }

    #[Route('/service_client', name: 'app_service_client')]
    public function service_client(Request $request, MailService $mailService): Response
    {
        $query =  $request->query;
        if ($query->get("nom") != "" && $query->get("prenom") != "" && $query->get("email") != "" && $query->get("question") != ""){

            $mailService->sendEmail(
            $query->get('email'),
            $query->get('question'),
            'serviceClient@bd_cda.com'
            );
        }

        return $this->render('footer/service_client.html.twig');
    }

    #[Route('/aide', name: 'app_aide')]
    public function aide(): Response
    {
        return $this->render('footer/aide.html.twig');
    }
}
