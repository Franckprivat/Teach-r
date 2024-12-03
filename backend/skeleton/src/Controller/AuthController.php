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


    #[Route("/api/login", name: "login", methods: ['POST'] )]

    public function login(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {

        $data = json_decode($request->getContent(), true);
        $email = $data['email'];
        $password = $data['password'];


        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

        if (!$user || !$passwordHasher->isPasswordValid($user, $password)) {
            return $this->json(['message' => 'Identifiants invalides'], Response::HTTP_UNAUTHORIZED);
        }


        return $this->json(['message' => 'Bienvenue !']);
    }

    

    #[Route("/api/signup", name: "signup", methods: ['POST'] )]

    public function signup(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {

        $data = json_decode($request->getContent(), true);
        $firstName = $data['firstName'];  
        $lastName = $data['lastName'];    
        $email = $data['email'];
        $password = $data['password'];


        $user = new User();
        $user->setFirstName($firstName);
        $user->setLastName($lastName);    
        $user->setEmail($email);
        $user->setPassword($passwordHasher->hashPassword($user, $password));  

        $entityManager->persist($user);
        $entityManager->flush();

        return new JsonResponse(['message' => 'Bienvenue ! Votre compte a été créé avec succès']); 
    }

}
