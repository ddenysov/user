<?php

namespace App\Tests\Service;

use App\Event\User\UserSignedUp;
use App\Service\SignUpUserService;
use App\Tests\FunctionalTestCase;
use Symfony\Component\Uid\Ulid;
use Zenstruck\Messenger\Test\InteractsWithMessenger;

class SignUpUserServiceTest extends FunctionalTestCase
{
    use InteractsWithMessenger;

    public function testSignUpEvent()
    {
        $service = $this->container->get(SignUpUserService::class);
        $this->assertTrue(true);
        $service->handle(
            id: Ulid::generate(),
            email: 'asdasd@sdds.com',
            password: 'lalala',
        );

        $this->assertEquals(1, $this->transport()->queue()->count());
        $this->transport()->queue()->assertContains(UserSignedUp::class);
        $this->transport()->process(1);
        $this->assertEquals(0, $this->transport()->queue()->count());
    }
}