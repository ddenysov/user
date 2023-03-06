<?php

namespace App\Tests\Controller\User;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SignUpControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $client->request('GET', '/sign-up');

        $json = json_decode($client->getResponse()->getContent(), true);

        $this->assertTrue(is_array($json));
    }
}
