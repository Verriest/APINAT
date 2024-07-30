<?php

namespace App\Controller;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class ApiController extends AbstractController
{
    #[Route('/api/login', name: 'api_token', methods: ['POST'])]
    public function getTokenUser(UserInterface $user, JWTTokenManagerInterface $JWTManager): Response
    {
        return new JsonResponse(['token' => $JWTManager->create($user)]);
    }
}
