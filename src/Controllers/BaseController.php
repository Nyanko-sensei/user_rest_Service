<?php

namespace UserListRest\Controllers;

use UserListRest\Interfaces\ResponseInterface;

class BaseController
{
    /** @var  ResponseInterface */
    protected $responseHandler;

    public function __construct(ResponseInterface $responseHandler)
    {
        $this->responseHandler = $responseHandler;
    }
}