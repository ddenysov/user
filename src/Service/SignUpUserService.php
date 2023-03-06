<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Uid\Ulid;

class SignUpUserService
{
    /**
     * @param UserRepository $userRepository
     */
    public function __construct(private readonly UserRepository $userRepository)
    {

    }

    public function handle(
        string $id,
        string $email,
        string $password,
    ): void
    {
        $user = new User(Ulid::fromString($id));
        $user->setEmail($email);
        $user->setPassword($password);

        $this->userRepository->save($user, true);
    }
}