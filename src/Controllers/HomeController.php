<?php

namespace UserListRest\Controllers;

class HomeController extends BaseController
{
    public function index()
    {
        $this->responseHandler->fail('test');
    }
}