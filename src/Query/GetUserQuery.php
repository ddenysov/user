<?php

namespace App\Query;

use Ddenysov\SymfonyBus\Query\Query;

class GetUserQuery implements Query
{
    public function __construct(public string $id)
    {
    }
}