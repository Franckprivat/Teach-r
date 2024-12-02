<?php
// src/Controller/AuthController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends AbstractController
{

    public function login(): Response
    {

        return $this->json(['message' => 'Login route working!']);
    }
}

