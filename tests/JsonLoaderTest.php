<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use UserListRest\Components\UserJsonLoader;
use UserListRest\Models\User;

final class  JsonLoaderTest extends TestCase
{
    /**
     * @group sp
     *
     * @test
     */
    public function canGetUsersFromJson(): void
    {
        $payload = [
            [
                'login' => 'login1',
                'password' => 'password1',
                'title' => 'mrs',
                'lastname' => 'foster',
                'firstname' => 'abigail',
                'gender' => 'female',
                'email' => 'example1@example.com',
                'picture' => 'https://api.randomuser.me/0.2/portraits/women/10.jpg',
                'address' =>'1851 saddle dr anna 69319',
            ],
            [
                'login' => 'login2',
                'password' => 'password2',
                'title' => 'ms',
                'lastname' => 'graham',
                'firstname' => 'allison',
                'gender' => 'female',
                'email' => 'example2@example.com',
                'picture' => 'https://api.randomuser.me/0.2/portraits/women/35.jpg',
                'address' => '6697 rolling green rd colorado springs 56306',
            ],
        ];


        $fp = fopen('test.json', 'w');
        fwrite($fp, json_encode($payload));
        fclose($fp);

        $csvLoader = new UserJsonLoader('test.json');
        /** @var User[] $users */
        $users = $csvLoader->loadUsersFromSource();

        $user1 = $users[0];
        $user2 = $users[1];

        $this->assertEquals("login1", $user1->getLogin());
        $this->assertEquals("password1", $user1->getPassword());
        $this->assertEquals("mrs", $user1->getTitle());
        $this->assertEquals("foster", $user1->getLastname());
        $this->assertEquals("abigail", $user1->getFirstname());
        $this->assertEquals("female", $user1->getGender());
        $this->assertEquals("example1@example.com", $user1->getEmail());
        $this->assertEquals("https://api.randomuser.me/0.2/portraits/women/10.jpg", $user1->getPicture());
        $this->assertEquals("1851 saddle dr anna 69319", $user1->getAddress());

        $this->assertEquals("login2", $user2->getLogin());
        $this->assertEquals("password2", $user2->getPassword());
        $this->assertEquals("ms", $user2->getTitle());
        $this->assertEquals("graham", $user2->getLastname());
        $this->assertEquals("allison", $user2->getFirstname());
        $this->assertEquals("female", $user2->getGender());
        $this->assertEquals("example2@example.com", $user2->getEmail());
        $this->assertEquals("https://api.randomuser.me/0.2/portraits/women/35.jpg", $user2->getPicture());
        $this->assertEquals("6697 rolling green rd colorado springs 56306", $user2->getAddress());

        unlink('test.json');
    }
}