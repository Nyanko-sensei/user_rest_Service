<?php

namespace UserListRest\Controllers;

use UserListRest\Components\UserTransformer;
use UserListRest\Interfaces\ResponseInterface;
use UserListRest\Interfaces\UserRepositoryInterface;

class UserController
{
    /** @var */
    private $userRepository;

    /** @var ResponseInterface  */
    private $responseHandler;

    public function __construct(UserRepositoryInterface $userRepository, ResponseInterface $responseHandler)
    {
        $this->userRepository = $userRepository;
        $this->responseHandler = $responseHandler;
    }

    public function show($var)
    {
        $user = $this->userRepository->getUserById($var['id']);
        $this->responseHandler->success(UserTransformer::transform($user));
    }

    public function index()
    {
        $limit = $_GET['limit'] ?? null;
        $offset = $_GET['offset'] ?? null;

        $users = $this->userRepository->getUsers($limit, $offset, $_GET);

        $responsePayload = [];

        foreach ($users as $user) {
            $responsePayload[] =  UserTransformer::transform($user);
        }

        $this->responseHandler->success($responsePayload);
    }
}

