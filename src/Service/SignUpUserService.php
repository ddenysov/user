<?php

namespace App\Service;

use App\Entity\User;
use App\Event\User\UserSignedUp;
use App\Repository\UserRepository;
use Ddenysov\SymfonyBus\Event\EventBusInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Uid\Ulid;

class SignUpUserService
{
    /**
     * @param UserRepository $userRepository
     * @param EventBusInterface $eventBus
     */
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly EventBusInterface $eventBus,
        private readonly LoggerInterface $logger,
    ) {
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
        $this->logger->debug('Sending user event');
        $this->eventBus->dispatch(new UserSignedUp($user->getId()));
    }
}