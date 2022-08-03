<?php

namespace App\Controller\Front;

use App\Repository\PizzaRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_front_home')]
    public function home(PizzaRepository $repository): Response
    {
        $pizzas = $repository -> findAll();

        return $this->render('front/home.html.twig', [
            'pizzas' => $pizzas,
        ]);
    }
}
