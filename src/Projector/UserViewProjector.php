<?php

namespace App\Projector;

use App\Event\User\UserSignedUp;
use App\MessageHandler\EventHandlerInterface;

class UserViewProjector implements EventHandlerInterface
{
    public function __invoke(UserSignedUp $event)
    {

    }
}