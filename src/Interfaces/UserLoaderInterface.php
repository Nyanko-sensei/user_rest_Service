<?php

namespace UserListRest\Interfaces;


use UserListRest\Models\User;

interface UserLoaderInterface
{
    /**
     *
     * @return User[]
     */
    public function loadUsersFromSource():array ;
}