<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use http\Client\Response;
use Symfony\Component\Routing\Annotation\Route;

class  ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    #[Route('/products', name: 'products_name')]
    public function showProducts(ManagerRegistry $doctrine):response {
        $products=$doctrine->getRepository(Product::class)->findAll();
        return $this->render('bezoeker/products.html.twig',['products'=>$products
        ]);
    }

    #[Route('/product', name: 'create_product')]
    public function createProduct(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $product = new Product();
        $product->setName('Keyboard');
        $product->setPrice(1999);
        $product->setDescription('Ergonomic and stylish!');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$product->getId());
    }
}