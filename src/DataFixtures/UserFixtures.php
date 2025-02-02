<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
            $user = new User();
            $user->setEmail("admin@admin.fr");
            $user->setPassword("adminadmin");
            $manager->persist($user);
        

        $manager->flush();
    }
}
