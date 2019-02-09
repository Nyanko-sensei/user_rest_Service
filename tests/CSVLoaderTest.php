<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use UserListRest\Components\UserCSVLoader;
use UserListRest\Models\User;

final class  CSVLoaderTest extends TestCase
{
    /**
     * @test
     */
    public function canGetTransactionsFromCSV(): void
    {
        file_put_contents('test.csv', "login,password,title,lastname,firstname,gender,email,picture,address\n");
        file_put_contents('test.csv', "login1,password1,mrs,foster,abigail,female,example1@example.com,https://api.randomuser.me/0.2/portraits/women/10.jpg,1851 saddle dr anna 69319\n", FILE_APPEND);
        file_put_contents('test.csv', "login2,password2,ms,graham,allison,female,example2@example.com,https://api.randomuser.me/0.2/portraits/women/35.jpg,6697 rolling green rd colorado springs 56306\n", FILE_APPEND);

        $this->assertEquals(1, 1);

        $csvLoader = new UserCSVLoader('test.csv');
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

        unlink('test.csv');
    }
}