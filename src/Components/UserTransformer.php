<?php

namespace UserListRest\Components;


use UserListRest\Models\User;

class UserTransformer
{
   static function transform(User  $user)
   {
       return [
           'login' => $user->getLogin(),
           'password' => $user->getPassword(),
           'title' => $user->getTitle(),
           'lastname' => $user->getLastname(),
           'firstname' => $user->getFirstname(),
           'gender' => $user->getGender(),
           'email' => $user->getEmail(),
           'picture' => $user->getPicture(),
           'address' => $user->getAddress(),
       ];
   }
}