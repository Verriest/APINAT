<?php

namespace App\Test\Controller;

use App\Entity\Permission;
use App\Repository\PermissionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class PermissionControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/api/permission/');
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/json');
    }

    public function testNew()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/permission/new',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['name' => 'PERMISSION_NEW'])
        );
        $this->assertResponseStatusCodeSame(Response::HTTP_CREATED);
        $this->assertResponseHeaderSame('Content-Type', 'application/json');
    }

    public function testShow()
    {
        $client = static::createClient();
        $permission = $this->createPermission();
        $client->request('GET', '/api/permission/' . $permission->getId());
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/json');
    }

    public function testEdit()
    {
        $client = static::createClient();
        $permission = $this->createPermission();
        $client->request(
            'POST',
            '/api/permission/' . $permission->getId() . '/edit',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['name' => 'PERMISSION_UPDATED'])
        );
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/json');
    }

    public function testDelete()
    {
        $client = static::createClient();
        $permission = $this->createPermission();
        $client->request(
            'POST',
            '/api/permission/' . $permission->getId(),
            ['_token' => 'valid_csrf_token']
        );
        $this->assertResponseStatusCodeSame(Response::HTTP_NO_CONTENT);
    }

    private function createPermission(): Permission
    {
        $permission = new Permission();
            $permission->setName('permission_99');
        return $permission;
    }
}
