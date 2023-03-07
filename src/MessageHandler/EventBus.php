<?php

namespace App\MessageHandler;

use Symfony\Component\Messenger\MessageBusInterface;

final class EventBus implements EventBusInterface
{
    public function __construct(private MessageBusInterface $eventBus)
    {
    }

    /**
     * @param Event $event
     * @return void
     */
    public function dispatch(Event $event): void
    {
        $this->eventBus->dispatch($event);
    }
}