<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;



#[Route('/product')]
final class ProductController extends AbstractController{

    #[Route(name: 'app_product_index', methods: ['POST'])]
    public function index(ProductRepository $productRepository): JsonResponse
    {
        $products => $productRepository->findAll(),
        return $this->json($product);
    }

    #[Route('/new', name: 'product_new', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $em,CategoryRepository $categoryRepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $category = $categoryRepository->find($data['category_id']);
        if (!$category) {
            return $this->json(['error' => 'Category not found'], Response::HTTP_BAD_REQUEST);
        }

        $product = new Product();
        $product->setName($data['Name']);
                ->setDescription($data['description']);
                ->setPrice($data['price']);
                ->setCreatedAt(new \DateTimeImmutable());
                ->setCategory($category);
                

        $errors = $validator->validate($product);
        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }
            return $this->json(['errors' => $errorMessages], 400);
        }

        $em -> persist($product);
        $em -> flush();

        return $this->json($product);
    }

    #[Route('/products/{id}', name: 'product_show', methods: ['GET'])]
    public function show(Product $product): JsonResponse
    {
        return $this->json($product);
    }

    #[Route('/product/{id}', name: 'product_edit', methods: ['PUT'])]
    public function edit(Request $request, Product $product, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if(isset($data['name']) {
            $product->setName($data['name']);
        });
        if(isset($data['description']) {
            $product->setDescription($data['description']);
        });
        if(isset($data['price']) {
            $product->setPrice($data['price']);
        });
        if(isset($data['name']) {
            $product->setCategory($data['category']);
        });
        if(isset($data['']) {
            $product->setCreatedAt(new \DateTimeImmutable());
            $product->setUpdatedAt(new \DateTimeImmutable());
        });

        $em -> flush();

        return $this->json($product);
    }

    #[Route('/product/{id}', name: 'product_delete', methods: ['DELETE'])]
    public function delete(Request $request, Product $product, EntityManagerInterface $em): JsonResponse
    {
        $em->remove($product);
        $em->flush();

        return $this->json(['message' => 'Product deleted !'], Response::HTTP_SEE_OTHER);
    }
}
