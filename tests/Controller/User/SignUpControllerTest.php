<?php

namespace App\Tests\Controller\User;

use App\Command\User\SignUpUserCommand;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Tests\FunctionalTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Uid\Ulid;
use Zenstruck\Messenger\Test\InteractsWithMessenger;

class SignUpControllerTest extends FunctionalTestCase
{
    use InteractsWithMessenger;

    public function testSomething(): void
    {
        $id     = Ulid::generate();
        $email  = 'test_' . md5(rand(1, 9999)) . '@gmail.com';
        $this->client->request('POST', '/sign-up', [
            'id'       => $id,
            'email'    => $email,
            'password' => '55555',
        ]);

        $json = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertEquals(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());
        $repo = static::getContainer()->get(UserRepository::class);

        $this->transport()->queue()->assertContains(SignUpUserCommand::class);
        $this->transport()->process();
        $this->transport()->queue()->assertEmpty();
        $this->assertInstanceOf(User::class, $repo->find($id));
    }
}
