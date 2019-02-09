<?php

namespace UserListRest\Controllers;

use UserListRest\Interfaces\ResponseInterface;

class HomeController
{
    /** @var ResponseInterface*/
    private $responseHandler;

    public function __construct(ResponseInterface $responseHandler)
    {
        $this->responseHandler = $responseHandler;
    }

    public function index()
    {
        $this->responseHandler->success(['msg' => 'Api works']);
    }
}