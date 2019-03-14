<?php

use PHPUnit\Framework\TestCase;

class UnitTest extends TestCase
{
    public function testName()
    {
        $name1 = 'aBcAbC'; // valid
        $name2 = 'abc4A'; // not valid
        $name3 = 'a'; // not valid
        $name4 = 'ddddddddddddddddddddddddddddddddddddddddddddfffffffffffffffffffffff'; // not valid

        $validation = new \App\Services\Validation();
        $this->assertEquals(1, $validation->name($name1));
        $this->assertEquals(0, $validation->name($name2));
        $this->assertEquals(0, $validation->name($name3));
        $this->assertEquals(0, $validation->name($name4));

    }

    public function testEmail()
    {
        $email1 = 'foo@example.com'; // valid
        $email2 = 'Foo.noo@example.com'; // valid
        $email3 = 'foo_noo@example.com'; // valid
        $email4 = 'Foo@Example.com'; // not valid
        $email5 = 'foo~noo@example.com'; // not valid
        $email6 = 'foo@example.net'; // not valid

        $validation = new \App\Services\Validation();

        $this->assertEquals(1, $validation->email($email1));
        $this->assertEquals(1, $validation->email($email2));
        $this->assertEquals(1, $validation->email($email3));
        $this->assertEquals(0, $validation->email($email4));
        $this->assertEquals(0, $validation->email($email5));
        $this->assertEquals(0, $validation->email($email6));

    }

    public function testPhone()
    {
        $phone1 = '962702545854'; // valid
        $phone2 = '96270254585'; // not valid
        $phone3 = '662702545854'; // not valid

        $validation = new \App\Services\Validation();

        $this->assertEquals(1, $validation->phone($phone1));
        $this->assertEquals(0, $validation->phone($phone2));
        $this->assertEquals(0, $validation->phone($phone3));
    }

    public function testSendSMS()
    {
        // valid
        $sms = new \App\Services\SMS();
        $data = [
            'AppSid' => 'SpRpFe5w7P_5XNxBF8BSnuk6PxXTc0',
            'Recipient' => '966541111111',
            'Body' => 'your verification is 6585',
            'SenderID' => 'test sender',
        ];

        $response = json_decode($sms->send($data), 1);
        $this->assertEquals('true', $response['success']);

        // not valid
        $data = [
            'AppSid' => 'SpRpFe5w7P_5XNxBF8BSnuk6PxXTc1',
            'Recipient' => '966541111111',
            'Body' => 'your verification is 6585',
            'SenderID' => 'test sender',
        ];

        $response = json_decode($sms->send($data), 1);
        $this->assertEquals('false', $response['success']);
    }
}
