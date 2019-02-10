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

    public function getUserById($id): User
    {
        return $this->users[$id-1] ?? null;
    }

    /**
     * @param $limit
     * @param $offset
     * @param $filter
     *
     * @return User[]
     */
    public function getUsers($limit = null, $offset = 0, $filter = []): array
    {
        $userCount = count($this->users);
        $i = 0;
        $result = [];


        while($i < $userCount && (empty($limit) || count($result) < $limit)) {
            if(empty($filter) || $this->userIsSuitableForFilter($this->users[$i],$filter)) {
                if ($offset <= 0) {
                    $result[] = $this->users[$i];
                }
                $offset--;
            }

            $i++;
        }
        return $result;
    }

    /**
     * @param User[] $users
     */
    public function setUsers(array $users)
    {
        $this->users = $users;
    }

    private function userIsSuitableForFilter(User $user, $filter)
    {
        if(!empty($filter['login']) && $user->getLogin() !=  $filter['login']) {
            return false;
        }

        if(!empty($filter['password']) && $user->getPassword() !=  $filter['password']) {
            return false;
        }

        if(!empty($filter['title']) && $user->getTitle() !=  $filter['title']) {
            return false;
        }

        if(!empty($filter['lastname']) && $user->getLastname() !=  $filter['lastname']) {
            return false;
        }

        if(!empty($filter['firstname']) && $user->getFirstname() !=  $filter['firstname']) {
            return false;
        }

        if(!empty($filter['gender']) && $user->getGender() !=  $filter['gender']) {
            return false;
        }

        if(!empty($filter['email']) && $user->getEmail() !=  $filter['email']) {
            return false;
        }

        if(!empty($filter['picture']) && $user->getPicture() !=  $filter['picture']) {
            return false;
        }

        if(!empty($filter['address']) && $user->getAddress() !=  $filter['address']) {
            return false;
        }

        return true;
    }
}