<?php

namespace App\Tests;

use Doctrine\DBAL\Connection;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class FunctionalTestCase extends WebTestCase
{
    protected KernelBrowser $client;
    protected Connection $connection;
    protected $container;
    protected $databaseTool;

    /**
     * @return void
     * @throws \Doctrine\DBAL\Exception
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
        $this->client->disableReboot();
        $this->container  = $this->client->getContainer();
        $this->connection = $this->container->get('doctrine')->getConnection();
        $this->connection->beginTransaction();
        $this->connection->setAutoCommit(false);
        $this->databaseTool = $this->container->get(DatabaseToolCollection::class)->get();
    }

    /**
     * @return void
     * @throws \Doctrine\DBAL\Exception
     */
    public function tearDown(): void
    {
        if ($this->connection->isTransactionActive()) {
            $this->connection->rollback();
        }
        parent::tearDown();
    }
}