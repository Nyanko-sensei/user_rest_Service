<?php

namespace UserListRest\Interfaces;


use UserListRest\Models\User;

interface UserRepositoryInterface
{
    public function getUserById(): User;

    /**
     * @param $limit
     * @param $offset
     * @param $filter
     *
     * @return User[]
     */
    public function getUsers($limit, $offset, $filter): array;
}