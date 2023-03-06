<?php

namespace App\Tests\Controller\User;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Uid\Ulid;

class SignUpControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $id     = Ulid::generate();
        $email  = 'test_' . md5(rand(1, 9999)) . '@gmail.com';
        $client = static::createClient();
        $client->request('POST', '/sign-up', [
            'id'       => $id,
            'email'    => $email,
            'password' => '55555',
        ]);

        $json = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals(Response::HTTP_CREATED, $client->getResponse()->getStatusCode());
        $repo = static::getContainer()->get(UserRepository::class);
        $this->assertInstanceOf(User::class, $repo->find($id));
    }
}
