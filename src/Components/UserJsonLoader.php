<?php

namespace UserListRest\Components;

use UserListRest\Interfaces\UserLoaderInterface;
use UserListRest\Models\User;

class UserJsonLoader implements UserLoaderInterface
{
    const PATH_TO_FILE = '../data/testtakers.json';

    /** @var  User[] */
    private $users = [];

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
        if (file_exists($this->path)) {
            $string = file_get_contents($this->path);
            $users = json_decode($string, true);

            foreach ($users as $userDataArray) {
                $user = new User();

                $user->setLogin($userDataArray['login'] ?? null);
                $user->setPassword($userDataArray['password'] ?? null);
                $user->setTitle($userDataArray['title'] ?? null);
                $user->setLastname($userDataArray['lastname' ?? null]);
                $user->setFirstname($userDataArray['firstname'] ?? null);
                $user->setGender($userDataArray['gender'] ?? null);
                $user->setEmail($userDataArray['email'] ?? null);
                $user->setPicture($userDataArray['picture'] ?? null);
                $user->setAddress($userDataArray['address'] ?? null);

                $this->users[] = $user;
            }
        }

        return $this->users;
    }
}