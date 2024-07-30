<?php

namespace App\Test\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class UserControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/api/user/');
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/json');
    }

    public function testNew()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/user/new',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['email' => 'test@example.com', 'password' => 'password', 'role' => 'ROLE_USER'])
        );
        $this->assertResponseStatusCodeSame(Response::HTTP_CREATED);
        $this->assertResponseHeaderSame('Content-Type', 'application/json');
    }

    public function testShow()
    {
        $client = static::createClient();
        $user = $this->createUser();
        $client->request('GET', '/api/user/' . $user->getId());
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/json');
    }

    public function testEdit()
    {
        $client = static::createClient();
        $user = $this->createUser();
        $client->request(
            'POST',
            '/api/user/' . $user->getId() . '/edit',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['email' => 'updated@example.com', 'password' => 'newpassword'])
        );
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/json');
    }

    public function testDelete()
    {
        $client = static::createClient();
        $user = $this->createUser();
        $client->request(
            'POST',
            '/api/user/' . $user->getId(),
            ['_token' => 'valid_csrf_token']
        );
        $this->assertResponseStatusCodeSame(Response::HTTP_NO_CONTENT);
    }

    public function testAddRole()
    {
        $client = static::createClient();
        $user = $this->createUser();
        $client->request(
            'POST',
            '/api/user/' . $user->getId() . '/roles',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['roleIds' => [1, 2]])
        );
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/json');
    }

    private function createUser(): User
    {
        $user = new User();
            $user->setEmail("admin@admin.fr");
            $user->setPassword("adminadmin");
        return $user;
    }
}
