<?php

namespace App\Controller;

use App\Command\User\SignUpUserCommand;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Uid\Ulid;

class GetUserController extends AbstractController
{
    #[Route('/get', name: 'user_get')]
    public function index(
        MessageBusInterface $queryBus,
        Request $request,
        UserRepository $userRepository,
        SerializerInterface $serializer,
    ): Response
    {
        $user = $userRepository->find(Ulid::fromString($request->get('id')));

        return new Response($serializer->serialize($user,'json'));
    }
}