<?php

namespace UserListRest\Components;

use UserListRest\Interfaces\UserLoaderInterface;
use UserListRest\Models\User;

class UserJsonLoader implements UserLoaderInterface
{
    const PATH_TO_FILE = '../data/testtakers.json';

    /** @var  User[] */
    private $users;

    /** @var  string */
    private $path;

    public function __construct($path = null)
    {
        $this->path = self::PATH_TO_FILE;

        if (!empty($path))  {
            $this->path = $path;
        }
    }

    /**
     *
     * @return User[]
     */
    public function loadUsersFromSource(): array
    {
        $user = new User();

        $this->users[] = $user;

        return $this->users;
    }
}