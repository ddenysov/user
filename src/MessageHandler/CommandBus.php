<?php

namespace App\MessageHandler;

use Symfony\Component\Messenger\MessageBusInterface;

final class CommandBus implements CommandBusInterface
{
    /**
     * @param MessageBusInterface $bus
     */
    public function __construct(private readonly MessageBusInterface $bus)
    {
    }

    /**
     * @param Command $command
     * @return void
     */
    public function dispatch(Command $command): void
    {
        $this->bus->dispatch($command);
    }
}