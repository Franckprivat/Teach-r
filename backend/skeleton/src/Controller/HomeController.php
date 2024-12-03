<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController{

    // #[Route("/", name: "home", methods: ['GET'] )]
    function index(): Response {

        return new Response('Bonjour les gens');
    }

}
