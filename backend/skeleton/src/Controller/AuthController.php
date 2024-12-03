<?php
// src/Controller/AuthController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class AuthController extends AbstractController
{

    // Se connecter
    #[Route("/login", name: "login", methods: ['POST'] )]

    public function login(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager): Response
    {
        // Récupère les données envoyés par le front

        $data = json_decode($request->getContent(), true);
        $email = $data['email'];
        $password = $data['password'];

        // Vérifie l'utilisateur

        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

        if (!$user || !$passwordEncoder->isPasswordValid($user, $password)) {
            return $this->json(['message' => 'Identifiants invalides'], Response::HTTP_UNAUTHORIZED);
        }

        // Valide la connection à cette utilisateur

        return $this->json(['message' => 'Bienvenue !']);

    } 


    // Pour s'inscrire
    #[Route("/signup", name: "signup", methods: ['POST'] )]

    public function signup(Request $request, UserPasswordEncoderInterface $password, EntityManagerInterface $entityManager): REsponse
    {
        // Récupère les données du front
    
        $data = json_decode($request->getContent(), true);
        $email = $data['email'];
        $password = $data[ 'password'];
    
        // Créer un nouvel utilisateur
    
        $user = new User();
        $user -> setEmail($email);
        $user -> setPassword($passwordEncoder->encodePassword($user, $password));

        // Sauvegarder dans la base de donnée
        $entityManager->persist($user);
        $entityManager->flush();

        // Valide la création d'un nouvel utilisateur
        return new JsonResponse(['message' => 'Bienvenue ! Votre compte a été créé avec succès']);

    }

}
