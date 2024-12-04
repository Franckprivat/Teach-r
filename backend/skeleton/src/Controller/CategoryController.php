<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class CategoryController extends AbstractController
{
    #[Route('/api/category', name: 'app_category_index', methods: ['GET'])]
    public function index(CategoryRepository $categoryRepository): JsonResponse
    {
   
        $categories = $categoryRepository->findAll();


        return $this->json($categories);
    }

    #[Route('/api/category/new', name: 'category_new', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $em): JsonResponse
    {
      
        $data = json_decode($request->getContent(), true);


        if (!isset($data['name'])) {
            return $this->json(['error' => 'Name is required'], Response::HTTP_BAD_REQUEST);
        }


        $category = new Category();
        $category->setName($data['name']);

        $em->persist($category);
        $em->flush();

        return $this->json(['id' => $category->getId(), 'name' => $category->getName()]);
    }

    #[Route('/api/category/{id}/show', name: 'app_category_show', methods: ['GET'])]
    public function show(Category $category): JsonResponse
    {
        if (!$category) {
            return $this->json(['error' => 'Category not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json($category, 200, [], ['groups' => 'category:read']);
    }

    #[Route('/api/category/{id}/edit', name: 'category_edit', methods: ['PUT'])]
    public function edit(Request $request, Category $category, EntityManagerInterface $em): JsonResponse
    {

        if (!$category) {
            return $this->json(['error' => 'Category not found'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        if (isset($data['name'])) {
            $category->setName($data['name']);
        }

        $em->flush();
        return $this->json($category);
    }

    #[Route('/api/category/{id}/delete', name: 'category_delete', methods: ['DELETE'])]
    public function delete(Category $category, EntityManagerInterface $em): JsonResponse
    {

        if (!$category) {
            return $this->json(['error' => 'Category not found'], Response::HTTP_NOT_FOUND);
        }

        $em->remove($category);
        $em->flush();

        return $this->json(['message' => 'Category deleted!']);
    }
}
