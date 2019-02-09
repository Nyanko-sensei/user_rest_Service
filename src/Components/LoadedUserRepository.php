<?php

namespace UserListRest\Components;


use UserListRest\Interfaces\UserLoaderInterface;
use UserListRest\Interfaces\UserRepositoryInterface;
use UserListRest\Models\User;

class LoadedUserRepository implements UserRepositoryInterface
{
    /**
     * @var User[]
     */
    private $users;

    private $userLoader;

    public function __construct(UserLoaderInterface  $userLoader)
    {
        $this->userLoader = $userLoader;
        $this->users = $this->userLoader->loadUsersFromSource();
    }

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
    public function getUsers($limit = null, $offset = null, $filter = null): array
    {
        return $this->users;
    }
}