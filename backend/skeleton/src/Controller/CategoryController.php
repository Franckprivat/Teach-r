<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/category')]
final class CategoryController extends AbstractController{
    #[Route(name: 'app_category_index', methods: ['GET'])]
    public function index(CategoryRepository $categoryRepository): JsonResponse
    {
        $category = $categoryRepository->findAll();
        return $this->json($category);
    }

    #[Route('/new', name: 'category_new', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $em): JsonResponse
        {
        $data = json_decode($request->getContent(), true);
        if (!isset($data['name'])) {
            return $this->json(['Invalid data']);
        }

        $category = new Category();
        $category->setName($data['name']);
        
        $em->persist($category);
        $em->flush();
        
        return $this->json(['id' => $category->getId(), 'name' => $category->getName()]);
    }
        
    #[Route('/{id}/show', name: 'app_category_show', methods: ['GET'])]
    public function show(Category $category): JsonResponse
    {
        return $this->json($category);
    }

    #[Route('/{id}/edit', name: 'category_edit', methods: ['PUT'])]
    public function edit(Request $request, Category $category, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if(isset($data['name'])) {
            $category->setName($data['name']);
        };

        $em -> flush();

        return $this->json($category);
    }

    #[Route('/{id}/delete', name: 'category_delete', methods: ['DELETE'])]
    public function delete(Request $request, Category $category, EntityManagerInterface $em): JsonResponse
    {
        $em->remove($category);
        $em->flush();

        return $this->json(['message' => 'Category deleted !']);
    }

}

