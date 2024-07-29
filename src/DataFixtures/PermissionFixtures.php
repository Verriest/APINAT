<?php

namespace App\DataFixtures;


use App\Entity\Permission;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PermissionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 20; $i++) {
            $permission = new Permission();
            $permission->setName('permission_'.$i);
            $manager->persist($permission);
        }

        $manager->flush();
    }
}
