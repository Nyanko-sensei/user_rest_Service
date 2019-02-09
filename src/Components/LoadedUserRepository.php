<?php

namespace UserListRest\Components;


use UserListRest\Interfaces\UserRepositoryInterface;
use UserListRest\Models\User;

class LoadedUserRepository implements UserRepositoryInterface
{
    public function getUserById(): User
    {
        // TODO: Implement getUserById() method.
    }

    /**
     * @param $limit
     * @param $offset
     * @param $filter
     *
     * @return User[]
     */
    public function getUsers($limit, $offset, $filter): array
    {
        // TODO: Implement getUsers() method.
    }
}