<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;


// #[Route("/", name: "home", methods: ['GET'])]
class HomeController extends AbstractController
{
    public function index(ProductRepository $productRepository, CategoryRepository $categoryRepository): JsonResponse
    {
        $products = $productRepository->findAll();
        
        $productData = [];
        foreach ($products as $product) {
            $productData[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'price' => $product->getPrice(),
            ];
        }

        return $this->json(['products' => $productData]);
    }
}

