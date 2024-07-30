<?php

namespace App\Test\Controller;

use App\Entity\Role;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class RoleControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/api/role/');
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/json');
    }

    public function testNew()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/role/new',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['name' => 'ROLE_NEW'])
        );
        $this->assertResponseStatusCodeSame(Response::HTTP_CREATED);
        $this->assertResponseHeaderSame('Content-Type', 'application/json');
    }

    public function testShow()
    {
        $client = static::createClient();
        $role = $this->createRole();
        $client->request('GET', '/api/role/' . $role->getId());
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/json');
    }

    public function testEdit()
    {
        $client = static::createClient();
        $role = $this->createRole();
        $client->request(
            'POST',
            '/api/role/' . $role->getId() . '/edit',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['name' => 'ROLE_UPDATED'])
        );
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/json');
    }

    public function testDelete()
    {
        $client = static::createClient();
        $role = $this->createRole();
        $client->request(
            'POST',
            '/api/role/' . $role->getId(),
            ['_token' => 'valid_csrf_token']
        );
        $this->assertResponseStatusCodeSame(Response::HTTP_NO_CONTENT);
    }

    public function testAddPermission()
    {
        $client = static::createClient();
        $role = $this->createRole();
        $client->request(
            'POST',
            '/api/role/' . $role->getId() . '/permissions',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['permissionIds' => [1, 2]])
        );
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/json');
    }

    private function createRole(): Role
    {
        $role = new Role();
            $role->setName('ROLE_ADMIN');

        return $role;
    }
}
