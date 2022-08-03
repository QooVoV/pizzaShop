<?php

namespace App\Controller\Admin;

use App\Entity\Pizza;
use App\Form\PizzaType;
use App\Repository\PizzaRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/pizza')]
class PizzaController extends AbstractController
{
    //create
    #[Route('/add', name: 'app_admin_pizza_add')]
    public function add(Request $request, PizzaRepository $repository): Response
    {
        $form = $this->createForm(PizzaType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pizza = $form->getData();
            $repository->add($pizza, true);

            return $this->redirectToRoute('app_admin_pizza_list');
        }

        $view = $form->createView();

        return $this->render('admin/pizza/add.html.twig', [
            'view' => $view,
        ]);
    }

    //read
    #[Route('/list', name: 'app_admin_pizza_list')]
    public function list(PizzaRepository $repository): Response
    {
        $pizzas = $repository->findAll();

        return $this->render('admin/pizza/list.html.twig', [
            'pizzas' => $pizzas,
        ]);
    }

    //update
    #[Route('/{id}/update', name: 'app_admin_pizza_update')]
    public function update(Pizza $pizza, Request $request, PizzaRepository $repository): Response 
    {
        $form = $this->createForm(PizzaType::class, $pizza);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pizza = $form->getData();
            $repository->add($pizza, true);

            return $this->redirectToRoute('app_admin_pizza_list');
        }

        $view = $form->createView();

        return $this->render('admin/pizza/update.html.twig', [
            'pizza' => $pizza,
            'view' => $view,
        ]);
    }

    //delete
    #[Route('/{id}/delete', name: 'app_admin_pizza_delete')]
    public function delete(Pizza $pizza, PizzaRepository $repository): Response
    {
        $repository->remove($pizza, true);

        return $this->redirectToRoute('app_admin_pizza_list');
    }
}
