<?php
namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: "home")]
    public function home(ManagerRegistry $doctrine): Response
    {
        $categories=$doctrine->getRepository(Category::class)->findAll();
        return $this->render('bezoeker/home.html.twig',['categories'=>$categories]);
    }
    #[Route('contact', name: "contact")]
    public function contact(): Response
    {
        return $this->render('bezoeker/contact.html.twig');
    }
    #[Route('login', name: "login")]
    public function login(): Response
    {
        return $this->render('bezoeker/login.html.twig');
    }
    #[Route('category/{id}', name: "products")]
    public function products(ManagerRegistry $doctrine, int $id): Response
    {
        $products=$doctrine->getRepository(Product::class)->findAll();
        return $this->render('bezoeker/products.html.twig',['products'=>$products]);
    }
}
