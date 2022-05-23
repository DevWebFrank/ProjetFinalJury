<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ProductController extends AbstractController
{
    #[Route('boutique/categorie/{id}', name: 'boutique_product_show_by_category')]
    public function showProductByCategory(int $id, CategoryRepository $categoryRepository)
    {
        $category = $categoryRepository->find($id);

        if (!$category) {
            return $this->redirectToRoute("home"); 
        }

        return $this->render("customer/product/show_by_category.html.twig", [
            'category' => $category
        ]);
    }

    #[Route('boutique/produit/{id}', name: 'boutique_product_detail')]
    public function detailProduct(int $id, ProduitRepository $produitRepository)
    {
        //je vais chercher un produit grace à l'id que j ai recu dans les parametres de l'url
        //Et avec l'aide du ProductRepositiry
        $product = $produitRepository->find($id);

        //Si je le trouve pas en bdd
        //Je redirige directement vers la page d'accueil
        if (!$product) {
            return $this->redirectToRoute("home");
        }

        //Je vais chercher la categorie associée au produit
        $category = $product->getCategory();

        //Je recupere tous les produits associés à cette catégorie
        $productsCategory = $category->getProduits();

        //j'initiliase un tableau vide
        //Mais j'ai pour but de le remplir avec 4 produits à suggérer au client
        $suggestedProducts = [];

        //Je boucle sur les produits associés à la catégorie
        //J'évite de mettre dans le tableau le meme produit que je présente actuellement
        foreach ($productsCategory as $item) {
            if ($item !== $product) {
                $suggestedProducts[] = $item;
            }
        }

        //J'utilise une fonction php pour envoyer seulement 4 produits de suggestion
        $suggestedProducts = array_slice($suggestedProducts, 0, 4);

        return $this->render("customer/product/detail_product.html.twig", [
            'product' => $product,
            'suggestedProducts' => $suggestedProducts
        ]);
    }

}