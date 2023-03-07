<?php

namespace App\Tests\Service;

use App\Event\User\UserSignedUp;
use App\Service\SignUpUserService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Uid\Ulid;
use Zenstruck\Messenger\Test\InteractsWithMessenger;

class SignUpUserServiceTest extends KernelTestCase
{
    use InteractsWithMessenger;

    public function testSignUpEvent()
    {
        $kernel = static::bootKernel();
        $service = $kernel->getContainer()->get(SignUpUserService::class);
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