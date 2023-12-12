<?php

namespace App\Controller;

use App\Entity\Bd;
use App\Entity\Categorie;
use App\Entity\Commande;
use App\Form\BdType;
use App\Form\CategoriePType;
use App\Form\CategorieType;
use App\Repository\BdRepository;
use App\Repository\CategorieRepository;
use App\Repository\CommandeRepository;
use App\Repository\LivraisonRepository;
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
            'bds' => $bd
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
            'form' => $form->createView()
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
    public function commande(CommandeRepository $commandeRepository, Request $request, PaginatorInterface $paginator, EntityManagerInterface $manager): Response
    {
        $commande = $paginator->paginate(
            $commandeRepository->findByExampleField(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/commande.html.twig', [
            'commandes' => $commande
        ]);
    }

    #[Route('/admin/commande/retard/{id}', name: 'app_admin_commande_retard')]
    public function retard(Commande $commande, LivraisonRepository $repo, EntityManagerInterface $manager): Response
    {
        $livraison = $repo->findOneBy(['id' => $commande->getLivraison()->getId()]);

        if ($livraison->isRetardEventuel()){
            $livraison->setRetardEventuel(false);
        }
        else {
            $livraison->setRetardEventuel(true);
        }

        $manager->persist($livraison);

        $manager->flush();

        return $this->redirectToRoute('app_admin_commande');
    }

    #[Route('/admin/commande/edition/{id}', name: 'app_admin_commande_edit')]
    public function editCommande(Commande $commande, EntityManagerInterface $manager): Response
    {
        if($commande->getEtatCommande() < 3){
            $commande->setEtatCommande($commande->getEtatCommande() + 1);
        }

        $manager->persist($commande);
        $manager->flush();

        return $this->redirectToRoute('app_admin_commande');
    }

    #[Route('/admin/Categorie', name: 'app_admin_categorie')]
    public function categorie(CategorieRepository $categorieRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $cat = $paginator->paginate(
            $categorieRepository->findAll(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/categorie.html.twig', [
            'categories' => $cat
        ]);
    }

    #[Route('/admin/Categorie/ajout', name: 'app_admin_categorie_ajout')]
    public function ajout_categorie(Request $request, EntityManagerInterface $manager): Response
    {

        $cat = new Categorie();
        $form = $this->createForm(CategorieType::class, $cat);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $cat = $form->getData();
            $manager->persist($cat);
            $manager->flush();

            return $this->redirectToRoute('app_admin_categorie');
        };

        return $this->render('admin/ajout_categorie.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/CategorieP/ajout', name: 'app_admin_categoriep_ajout')]
    public function ajout_categoriep(Request $request, EntityManagerInterface $manager): Response
    {

        $cat = new Categorie();
        $form = $this->createForm(CategoriePType::class, $cat);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $cat = $form->getData();
            $cat->setCategorie(null);
            $manager->persist($cat);
            $manager->flush();

            return $this->redirectToRoute('app_admin_categorie');
        };

        return $this->render('admin/ajout_categoriep.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('//admin/Categorie/supprimer/{id}', name: 'app_admin_categorie_supprimer')]
    public function supprimer_categorie(Categorie $cat, EntityManagerInterface $manager): Response
    {
        $manager->remove($cat);
        $manager->flush();

        return $this->redirectToRoute('app_admin_categorie');
    }
}