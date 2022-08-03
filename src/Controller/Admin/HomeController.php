<?php

namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin')]
class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_admin_home')]
    public function home(): Response
    {
        return $this->render('admin/home.html.twig',);
    }
}
