<?php

namespace UserListRest\Interfaces;

use UserListRest\Models\User;

interface ResponseInterface
{
    /**
     * @param string $msg
     *
     * @return mixed
     */
    public function fail(string $msg);

    /**
     * @param array $payload
     *
     * @return mixed
     */
    public function success(array $payload);
}