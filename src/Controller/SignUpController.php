<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Ulid;

class SignUpController extends AbstractController
{
    #[Route('/sign-up', name: 'app_sign_up')]
    public function index(UserRepository $repository, Request $request): JsonResponse
    {
        $user = new User(id: Ulid::fromString($request->get('id')));
        $user->setEmail('aasas@gmail.com');
        $user->setPassword('asdasd');
        $repository->save($user, true);

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/SignUpController.php',
        ]);
    }
}
