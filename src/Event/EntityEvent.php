<?php

namespace App\Event;

use Ddenysov\SymfonyBus\Event\Event;
use Symfony\Component\Uid\Ulid;

abstract class EntityEvent implements Event
{
    /**
     * @param Ulid $id
     */
    public function __construct(private readonly Ulid $id)
    {
    }

    /**
     * @return Ulid
     */
    public function getId(): Ulid
    {
        return $this->id;
    }
}