<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\SignUpUserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Ulid;

class SignUpController extends AbstractController
{
    #[Route('/sign-up', name: 'app_sign_up')]
    public function index(SignUpUserService $service, Request $request): JsonResponse
    {
        $service->handle(
            id: $request->get('id'),
            email: $request->get('email'),
            password: $request->get('password')
        );

        return new JsonResponse([], Response::HTTP_CREATED);
    }
}
