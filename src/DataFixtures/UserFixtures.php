<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Ulid;

class UserFixtures extends Fixture
{
    const DEFAULT_ID = '0186b8ae-6c26-3748-e6c4-112083af1439';

    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $user = new User(id: new Ulid(Ulid::fromRfc4122(self::DEFAULT_ID)));
        $user->setEmail('test@gmail.com');
        $user->setPassword('55555');
        $manager->persist($user);

        $manager->flush();
    }
}
