<?php

namespace UserListRest\Controllers;

use UserListRest\Interfaces\UserRepositoryInterface;

class UserController extends BaseController
{
    /** @var */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function show()
    {
        die("pika");
    }
}

