<?php

namespace App\Query;

use App\Entity\User;
use App\Service\GetUserService;
use Ddenysov\SymfonyBus\Query\QueryHandlerInterface;
use Symfony\Component\Uid\Ulid;

class GetUserQueryHandler implements QueryHandlerInterface
{
    /**
     * @param GetUserService $getUserService
     */
    public function __construct(private GetUserService $getUserService)
    {

    }

    /**
     * @param GetUserQuery $query
     * @return User
     */
    public function __invoke(GetUserQuery $query): User
    {
        return $this->getUserService->handle(Ulid::fromRfc4122($query->id));
    }
}