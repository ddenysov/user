<?php

namespace App\Command\User;

use App\Service\SignUpUserService;
use Ddenysov\SymfonyBus\Command\CommandHandlerInterface;

final class SignUpUserCommandHandler implements CommandHandlerInterface
{
    /**
     * @param SignUpUserService $signUpUserService
     */
    public function __construct(private readonly SignUpUserService $signUpUserService)
    {

    }

    /**
     * @param SignUpUserCommand $command
     * @return void
     */
    public function __invoke(SignUpUserCommand $command): void
    {
        $this->signUpUserService->handle(
            id: $command->id,
            email: $command->email,
            password: $command->password,
        );
    }
}