<?php
namespace App\Controller;

use App\Entity\Category;
use App\Entity\Orders;
use App\Entity\Product;
use App\Entity\Accounts;
use App\Form\InlogType;
use App\Form\OrderType;
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
        $Accounts=new Accounts();
        $form=$this->createForm(InlogType::class,$Accounts);
        return $this->renderForm('bezoeker/login.html.twig', ['inlogform'=>$form]);
    }
    #[Route('category/{id}', name: "products")]
    public function products(ManagerRegistry $doctrine, int $id): Response
    {
        $category=$doctrine->getRepository(Category::class)->find($id);
        return $this->render('bezoeker/products.html.twig',['category'=>$category]);
    }

    #[Route('bestel/{id}', name: "bestel")]
    public function bestel(ManagerRegistry $doctrine, int $id): Response
    {
        $order=new Orders();
        $form=$this->createForm(OrderType::class,$order);
        $product=$doctrine->getRepository(Product::class)->find($id);

        return $this->renderForm('bezoeker/bestel.html.twig', ['orderForm' => $form,'product'=>$product]);
    }
}
