<?php

namespace App\Controller;

use App\Command\User\SignUpUserCommand;
use App\Event\User\UserSignedUp;
use Ddenysov\SymfonyBus\Command\CommandBusInterface;
use Ddenysov\SymfonyBus\Event\EventBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Ulid;

class TestEventController extends AbstractController
{
    #[Route('/test-event', name: 'app_test')]
    public function index(EventBusInterface $bus): JsonResponse
    {
        $bus->dispatch(new UserSignedUp(id: new Ulid()));

        return new JsonResponse([], Response::HTTP_CREATED);
    }
}
