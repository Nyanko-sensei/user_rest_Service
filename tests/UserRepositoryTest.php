<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use UserListRest\Components\LoadedUserRepository;
use UserListRest\Components\UserCSVLoader;
use UserListRest\Components\UserJsonLoader;
use UserListRest\Models\User;

final class UserRepositoryTest extends TestCase
{
    /**
     * @group sp
     *
     * @test
     */
    public function canFilterUsers(): void
    {

        file_put_contents('test.csv', "login,password,title,gender\n");
        file_put_contents('test.csv', "login1,password1,mrs,female\n", FILE_APPEND);
        file_put_contents('test.csv', "login2,password2,ms,female\n", FILE_APPEND);
        file_put_contents('test.csv', "login3,password3,mrs,female\n", FILE_APPEND);
        file_put_contents('test.csv', "login4,password4,mr,male\n", FILE_APPEND);
        file_put_contents('test.csv', "login5,password5,mr,male\n", FILE_APPEND);
        file_put_contents('test.csv', "login6,password6,ms,female\n", FILE_APPEND);
        file_put_contents('test.csv', "login7,password7,mrs,female\n", FILE_APPEND);
        file_put_contents('test.csv', "login8,password8,ms,female\n", FILE_APPEND);

        $userRepository = new LoadedUserRepository(new UserCSVLoader('test.csv'));

        $thirdUser = $userRepository->getUserById(3);
        $this->assertEquals("login3", $thirdUser->getLogin());

        $thirdAndForthFemale = $userRepository->getUsers(2, 2, ['gender' => 'female']);
        $thirdFemale = $thirdAndForthFemale[0];
        $forthFemale = $thirdAndForthFemale[1];
        $this->assertEquals(2, count($thirdAndForthFemale));
        $this->assertEquals("login3", $thirdFemale->getLogin());
        $this->assertEquals("login6", $forthFemale->getLogin());


        unlink('test.csv');
    }
}