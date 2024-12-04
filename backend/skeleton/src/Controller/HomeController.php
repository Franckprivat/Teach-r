<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;




#[Route("/", name: "home", methods: ['GET'])]
class HomeController extends AbstractController{    
    public function index(ProductRepository $productRepository, CategoryRepository $categoryRepository): JsonResponse
    {
        $products = $productRepository->findAll();
        $category = $categoryRepository->findAll();
        
        $data = [
            'products' => $products,
            'categories' => $categories,
        ];

        return $this->json($data);
    }
    
}

