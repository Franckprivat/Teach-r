<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;




final class ProductController extends AbstractController{

    #[Route( '/product',name: 'product_index', methods: ['POST'])]
    public function index(ProductRepository $productRepository): JsonResponse
    {
        $products = $productRepository->findAll();
        return $this->json($product);
    }

    #[Route('/product/new', name: 'product_new', methods: ['POST'])]
public function new(Request $request, EntityManagerInterface $em, CategoryRepository $categoryRepository, ValidatorInterface $validator): JsonResponse
{
    $data = json_decode($request->getContent(), true);
    if (!isset($data['name'], $data['description'], $data['price'], $data['category_id'])) {
        return $this->json(['error' => 'Invalid data'], Response::HTTP_BAD_REQUEST);
    }

    $category = $categoryRepository->find($data['category_id']);
    if (!$category) {
        return $this->json(['error' => 'Category not found'], Response::HTTP_BAD_REQUEST);
    }

    $product = new Product();
    $product->setName($data['name'])
            ->setDescription($data['description'])
            ->setPrice($data['price'])
            ->setCreatedAt(new \DateTimeImmutable())
            ->setCategory($category);

    
    $errors = $validator->validate($product);
    if (count($errors) > 0) {
        $errorMessages = [];
        foreach ($errors as $error) {
            $errorMessages[] = $error->getMessage();
        }
        return $this->json($errorMessages);
    }

    $em->persist($product);
    $em->flush();

    return $this->json($product);
}

    #[Route('/product/{id}/show', name: 'product_show', methods: ['GET'])]
    public function show(int $id, ProductRepository $productRepository): JsonResponse
    {
        $product = $productRepository->find($id);

        if (!$product) {
            return $this->json(['error' => 'Product not found']);
        }

        return $this->json([
            'id' => $product->getId(),
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'price' => $product->getPrice(),
            'created_at' => $product->getCreatedAt()->format('d-m-Y'),
        ]);
    }

    #[Route('/product/{id}/edit', name: 'product_edit', methods: ['PUT'])]
public function edit(Request $request, Product $product, EntityManagerInterface $em, CategoryRepository $categoryRepository): JsonResponse
{
    $data = json_decode($request->getContent(), true);

    if (isset($data['name'])) {
        $product->setName($data['name']);
    }

    if (isset($data['description'])) {
        $product->setDescription($data['description']);
    }

    if (isset($data['price'])) {
        $product->setPrice($data['price']);
    }

    $product->setUpdatedAt(new \DateTimeImmutable());
    // if (isset($data['updated_at'])) {
    //     $product->setUpdatedAt(new \DateTimeImmutable($data['updated_at']));
    // } else {
    //     $product->setUpdatedAt(new \DateTimeImmutable());
    // }

    if (isset($data['category_id'])) {
        $category = $categoryRepository->find($data['category_id']);
        if ($category) {
            $product->setCategory($category);
        } else {
            return $this->json(['error' => 'Category not found']);
        }
    }

    $em->flush();

    return $this->json($product);
}


    #[Route('/product/{id}/delete', name: 'product_delete', methods: ['DELETE'])]
    public function delete(Request $request, Product $product, EntityManagerInterface $em): JsonResponse
    {
        $em->remove($product);
        $em->flush();

        return $this->json(['message' => 'Product deleted !']);
    }
}
