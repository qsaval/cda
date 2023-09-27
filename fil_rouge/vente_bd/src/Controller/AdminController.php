<?php

namespace App\Controller;

use App\Entity\Bd;
use App\Form\BdType;
use App\Repository\BdRepository;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    #[Route('/admin/BD', name: 'app_admin_bd')]
    public function bd(BdRepository $bdRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $bd = $paginator->paginate(
            $bdRepository->findAll(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/bd.html.twig', [
            'bds' => $bd,
            'routes' => '/admin/BD'
        ]);
    }

    #[Route('/admin/BD/ajout', name: 'app_admin_bd_ajout')]
    public function ajout_bd(Request $request, EntityManagerInterface $manager): Response
    {
       
        $bd = new Bd();
        $form = $this->createForm(BdType::class, $bd);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $bd = $form->getData();
            $manager->persist($bd);
            $manager->flush();

            return $this->redirectToRoute('app_admin_bd');
        };

        return $this->render('admin/ajout_bd.html.twig', [
            'form' => $form->createView(),
            'routes' => '/admin/BD/ajout'
        ]);
    }

    #[Route('/admin/BD/supprimer/{id}', name: 'app_admin_bd_supprimer')]
    public function supprimer_bd(Bd $bd, EntityManagerInterface $manager): Response
    {
        $manager->remove($bd);
        $manager->flush();

        return $this->redirectToRoute('app_admin_bd');
    }

    #[Route('/admin/commande', name: 'app_admin_commande')]
    public function commande(CommandeRepository $commandeRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $commande = $paginator->paginate(
            $commandeRepository->findByExampleField(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/commande.html.twig', [
            'commandes' => $commande,
            'routes' => '/admin/commande'
        ]);
    }
}