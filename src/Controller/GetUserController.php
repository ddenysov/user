<?php

namespace App\Controller;

use App\Query\GetUserQuery;
use App\Repository\UserRepository;
use Ddenysov\SymfonyBus\Query\QueryBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class GetUserController extends AbstractController
{
    use HandleTrait;

    #[Route('/get', name: 'user_get')]
    public function index(
        QueryBusInterface $queryBus,
        Request $request,
        UserRepository $userRepository,
        SerializerInterface $serializer,
    ): Response
    {
        $user = $queryBus->query(new GetUserQuery($request->get('id')));

        return new Response($serializer->serialize($user,'json'));
    }
}