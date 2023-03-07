<?php

namespace App\Controller;

use App\Command\User\SignUpUserCommand;
use App\MessageHandler\CommandBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Ulid;

class SignUpController extends AbstractController
{
    #[Route('/sign-up', name: 'app_sign_up')]
    public function index(CommandBusInterface $bus, Request $request): JsonResponse
    {
        $bus->dispatch(new SignUpUserCommand(
                id: $request->get('id', Ulid::generate()),
                email: $request->get('email', 'aaaa1@gmail.com'),
                password: $request->get('password', '123')
            )
        );

        return new JsonResponse([], Response::HTTP_CREATED);
    }
}
