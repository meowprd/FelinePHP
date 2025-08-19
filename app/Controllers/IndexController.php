<?php

namespace App\Controllers;

use App\Entities\User;
use App\Repositories\UserRepository;
use meowprd\FelinePHP\Controller\AbstractController;
use meowprd\FelinePHP\Http\Response;

class IndexController extends AbstractController
{
    public function __construct(
        private readonly UserRepository $userRepository,
    ) {}

    public function index(): Response {
        $user = new User('tester');
        $user->setPasswordWithoutTouch('123456');
        $this->userRepository->save($user);
        return new Response('User created');
    }

    public function get(int $id): Response {
        dd($this->userRepository->findBy(array('id' => $id, 'login' => 'meowprd')));
        return new Response('');
    }
}