<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: "home")]
    public function home(): Response
    {
        return $this->render('bezoeker/home.html.twig');
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
}
