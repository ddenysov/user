<?php

namespace App\Tests\Controller\User;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Uid\Ulid;

class SignUpControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $id     = Ulid::generate();
        $client = static::createClient();
        $client->request('POST', '/sign-up', [
            'id' => $id,
        ]);

        $json = json_decode($client->getResponse()->getContent(), true);
        $this->assertTrue(is_array($json));
        $repo = static::getContainer()->get(UserRepository::class);
        $this->assertInstanceOf(User::class, $repo->find($id));
    }
}
