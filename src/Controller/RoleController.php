<?php

namespace App\Controller;

use App\Entity\Permission;
use App\Entity\Role;
use App\Form\RoleType;
use App\Repository\RoleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('api/role')]
class RoleController extends AbstractController
{
    #[Route('/', name: 'app_role_index', methods: ['GET'])]
    public function index(RoleRepository $roleRepository): Response
    {
        return $this->json($roleRepository->findAll());
    }

    #[Route('/new', name: 'app_role_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);
        $permission = new Role();
        $permission->setName($data['name']);

            $entityManager->persist($permission);
            $entityManager->flush();

        return $this->json($permission, Response::HTTP_CREATED);
    }

    #[Route('/{id}', name: 'app_role_show', methods: ['GET'])]
    public function show(Role $role): Response
    {
        return $this->json($role);
    }

    #[Route('/{id}/edit', name: 'app_role_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Role $role, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);

        if (isset($data['name'])) {
            $role->setName($data['name']);
        }

        $entityManager->flush();

        return $this->json($role);
    }

    #[Route('/{id}', name: 'app_role_delete', methods: ['POST'])]
    public function delete(Request $request, Role $role, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$role->getId(), $request->request->get('_token'))) {
            $entityManager->remove($role);
            $entityManager->flush();
        }

        return new Response(null, Response::HTTP_NO_CONTENT);
    }


    #[Route('/{id}/permissions', name: 'app_role_add_permission', methods: ['POST'])]
    public function addPermission(Request $request, Role $role, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);
        $permissions = $entityManager->getRepository(Permission::class)->findBy(['id' => $data['permissionIds']]);
        foreach ($permissions as $permission) {
            $role->addPermission($permission);
        }
        $entityManager->flush();
        return $this->json($role);
    }
}
