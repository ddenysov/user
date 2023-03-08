<?php

namespace App\Event;

use App\Event\User\UserSignedUp;
use Ddenysov\SymfonyBus\Event\EventHandlerInterface;

class UserEventListener implements EventHandlerInterface
{
    public function __invoke(UserSignedUp $event)
    {
    }
}