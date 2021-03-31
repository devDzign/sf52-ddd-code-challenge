<?php

namespace App\Infrastructure\Adapter\Doctrine\DataFixtures;

use App\Infrastructure\Adapter\Doctrine\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setPseudo("used_pseudo");
        $user->setEmail("used@email.com");
        $user->setPassword(password_hash("password", PASSWORD_ARGON2I));
        $manager->persist($user);
        $manager->flush();
    }
}
