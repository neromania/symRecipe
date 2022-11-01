<?php

namespace App\Controller;

use App\Repository\IngredientRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IngredientController extends AbstractController
{ 
    /**
     * This function allows you to display all the ingredients
     *
     * @param IngredientRepository $repo
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/ingredient', name: 'app_ingredient', methods: ['GET'])]
    public function index(IngredientRepository $repo, PaginatorInterface $paginator, Request $request): Response
    {
        $ingredients = $paginator->paginate(
            $repo->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        return $this->render('ingredient/index.html.twig', [
            'controller_name' => 'IngredientController',
            'ingredients' =>  $ingredients,
        ]);
    }
}
