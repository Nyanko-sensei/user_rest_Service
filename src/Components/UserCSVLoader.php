<?php

namespace UserListRest\Components;

use UserListRest\Interfaces\UserLoaderInterface;
use UserListRest\Models\User;

class UserCSVLoader implements UserLoaderInterface
{
    const PATH_TO_FILE = '../data/testtakers.csv';

    /** @var  User[] */
    private $users = [];

    /** @var  string */
    private $path;

    /** @var  array */
    private $headers;

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
            $file = fopen($this->path, "r");

            $this->loadHeaders($file);

            $i = 1;

            while (! feof($file)) {

                $line = fgetcsv($file);

                if ($line) {
                    $this->processLine($line, $i);
                    $i++;
                };
            }

            fclose($file);
        }


        return $this->users;
    }

    /**
     * @param $file
     */
    private function loadHeaders($file)
    {
        $headers = fgetcsv($file);
        $this->headers = array_flip($headers);
    }

    /**
     * @param $line
     */
    private function processLine($line, $id): void
    {
        $user = new User();

        $user->setUserId($id);

        if (isset($this->headers['login'])) {
            $user->setLogin($line[$this->headers['login']]);
        }

        if (isset($this->headers['password'])) {
            $user->setPassword($line[$this->headers['password']]);
        }

        if (isset($this->headers['title'])) {
            $user->setTitle($line[$this->headers['title']]);
        }

        if (isset($this->headers['lastname'])) {
            $user->setLastname($line[$this->headers['lastname']]);
        }

        if (isset($this->headers['firstname'])) {
            $user->setFirstname($line[$this->headers['firstname']]);
        }

        if (isset($this->headers['gender'])) {
            $user->setGender($line[$this->headers['gender']]);
        }

        if (isset($this->headers['email'])) {
            $user->setEmail($line[$this->headers['email']]);
        }

        if (isset($this->headers['picture'])) {
            $user->setPicture($line[$this->headers['picture']]);
        }

        if (isset($this->headers['address'])) {
            $user->setAddress($line[$this->headers['address']]);
        }


        $this->users[] = $user;
    }
}