<?php

namespace App\Tests\Controller\User;

use App\DataFixtures\UserFixtures;
use App\Tests\FunctionalTestCase;
use Symfony\Component\Uid\Ulid;
use Zenstruck\Messenger\Test\InteractsWithMessenger;

class GetUserController extends FunctionalTestCase
{
    use InteractsWithMessenger;

    public function testSomething(): void
    {
        $this->databaseTool->loadFixtures([
            UserFixtures::class
        ]);

        $this->client->request('GET', '/get', [
            'id' => UserFixtures::DEFAULT_ID,
        ]);

        $this->assertResponseIsSuccessful();

        $response = $this->client->getResponse()->getContent();
        $data = json_decode($response, true);
        $this->assertEquals(Ulid::fromString(UserFixtures::DEFAULT_ID), $data['id']);
        $this->assertFalse(isset($data['password']));
    }
}
