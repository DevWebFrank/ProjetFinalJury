<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/admin_product')]
class AdminProductController extends AbstractController
{
    // fonction qui affiche tous les produits
    #[Route('/', name: 'admin_product_index', methods: ['GET'])]
    public function index(ProduitRepository $produitRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $products = $paginator->paginate(
            $produitRepository->findBy([], ['id' => 'DESC']), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            6 /*max par page*/
        );

        return $this->render('admin/admin_product/index.html.twig', [
            'products' => $products,
        ]);
    }

    // fonction qui permet de créer un nouveau produit 
    #[Route('/new', name: 'admin_product_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        //j'instancie un nouveau objet produit
        $produit = new Produit();
        //j'appelle doctrine pour créer un formulaire
        $form = $this->createForm(ProduitType::class, $produit);
        //demande de traitement de la saisie du formulaire
        $form->handleRequest($request);

        //si le formulaire et soumis et qu'il est valide
        if ($form->isSubmitted() && $form->isValid()) {
            //j'indique à EM que cette objet devra etre enregistré
            $entityManager->persist($produit);
            //enregistrement de l'objet dans la BDD
            $entityManager->flush();

            // redirection vers la page qui a pour name "admin_product_index"
            return $this->redirectToRoute('admin_product_index', [], Response::HTTP_SEE_OTHER);
        }

        // creation de la view du formulaire sur la page 'admin/admin_product/new.html.twig'
        return $this->renderForm('admin/admin_product/new.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    // fonction qui affiche un seul produit avec {id}
    #[Route('/{id}', name: 'admin_product_show', methods: ['GET'])]
    public function show(Produit $produit): Response
    {
        return $this->render('admin/admin_product/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    // fonction qui permet d'éditer un produit avec son {id}
    #[Route('/{id}/edit', name: 'admin_product_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
    {
        //j'appelle doctrine pour créer un formulaire
        $form = $this->createForm(ProduitType::class, $produit);
        //demande de traitement de la saisie du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/admin_product/edit.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    // fonction qui permet de supprimmer un produit
    #[Route('/{id}', name: 'admin_product_delete', methods: ['POST'])]
    public function delete(Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
    {
        // si le Csrf token est valide
        if ($this->isCsrfTokenValid('delete' . $produit->getId(), $request->request->get('_token'))) {
            //j'indique à EM que cette objet va etre supprimé
            $entityManager->remove($produit);
            //enregistrement de la suppression de l'objet dans la BDD
            $entityManager->flush();

            //Message flash l'article a bien été suppimé de la BDD
            $this->addflash('delete', 'le produit a bien été supprimé !');
            return $this->redirectToRoute('admin_product_index');

        }

        //retourne à "admin_product_index" (la liste des produits)
        return $this->redirectToRoute('admin_product_index', [], Response::HTTP_SEE_OTHER);
    }
}
