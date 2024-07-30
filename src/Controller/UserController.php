<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('api/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->json($userRepository->findAll());
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);
        $user = new User();
            if (isset($data['email'])) {
                $user->setEmail($data['email']);
            }
            if (isset($data['password'])) {
                $user->setPassword($data['password']);
            }
            if (isset($data['role'])) {
                $user->setRoles($data['role']);
            }
            $entityManager->persist($user);
            $entityManager->flush();

        return $this->json($user, Response::HTTP_CREATED);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->json($user);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);
        $user = new User();
            if (isset($data['email'])) {
                $user->setEmail($data['email']);
            }
            if (isset($data['password'])) {
                $user->setPassword($data['password']);
            }
            if (isset($data['role'])) {
                $user->setRoles($data['role']);
            }
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->json($user);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return new Response(null, Response::HTTP_NO_CONTENT);
    }


    #[Route('/{id}/roles', name: 'app_user_add_role', methods: ['POST'])]
    public function addRole(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);
        $roles = $entityManager->getRepository(Role::class)->findBy(['id' => $data['roleIds']]);
        foreach ($roles as $role) {
            $user->addRole($role);
        }
        $entityManager->flush();
        return $this->json($user);
    }
}
