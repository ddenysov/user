<?php

namespace App\Event;

use App\Event\User\UserSignedUp;
use App\MessageHandler\EventHandlerInterface;

class UserEventListener implements EventHandlerInterface
{
    public function __invoke(UserSignedUp $event)
    {
    }
}