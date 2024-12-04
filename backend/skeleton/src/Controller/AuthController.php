<?php
// src/Controller/AuthController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse; 
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class AuthController extends AbstractController
{

    #[Route('/api/login', name: 'auth_login', methods: ['POST'])]
    public function login(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {

        $data = json_decode($request->getContent(), true);

        if (!isset($data['email']) || !isset($data['password'])) {
            return $this->json(['error' => 'Champs requis']);
        }

        
        $email = $data['email'];
        $password = $data['password'];

        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

        if (!$user || !$passwordHasher || !$passwordHasher->isPasswordValid($user, $password)) {
            return $this->json(['message' => 'Identifiants invalides']);
        }


        return $this->json(['message' => 'Bienvenue !']);
    }

    

    #[Route('/api/signup', name: 'auth_signup', methods: ['POST'])]
    public function signup(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {

        $data = json_decode($request->getContent(), true);

        if (!isset($data['firstName'], $data['lastName'], $data['email'], $data['password'])) {
            return new JsonResponse(['error' => 'Invalid input']);
        }

        $user = new User();
        $user->setFirstName($data['firstName']);
        $user->setLastName($data['lastName']);    
        $user->setEmail($data['email']);

        $hashedPassword = $passwordHasher->hashPassword($user, $data['password']);
        $user->setPassword($hashedPassword);


        $entityManager->persist($user);
        $entityManager->flush();

        return new JsonResponse(['message' => 'Bienvenue !']); 
    }

}
