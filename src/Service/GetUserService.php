<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Uid\Ulid;

class GetUserService
{
    /**
     * @param UserRepository $userRepository
     */
    public function __construct(
        private readonly UserRepository $userRepository,
    ) {
    }

    /**
     * @param Ulid $id
     * @return User
     */
    public function handle(Ulid $id): User
    {
        return $this->userRepository->find($id);
    }
}