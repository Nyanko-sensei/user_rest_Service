<?php

namespace UserListRest\Interfaces;


use UserListRest\Models\User;

interface UserRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return User|null
     */
    public function getUserById(int $id);

    /**
     * @param $limit
     * @param $offset
     * @param $filter
     *
     * @return User[]
     */
    public function getUsers($limit = null, $offset = null, $filter = []): array;
}