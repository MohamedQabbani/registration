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

        $reg = new \App\Controllers\Registration();
        $this->assertEquals(1, $reg->validName($name1));
        $this->assertEquals(0, $reg->validName($name2));
        $this->assertEquals(0, $reg->validName($name3));
        $this->assertEquals(0, $reg->validName($name4));

    }

    public function testEmail()
    {
        $name1 = 'foo@example.com'; // valid
        $name2 = 'Foo.noo@example.com'; // valid
        $name3 = 'foo_noo@example.com'; // valid
        $name4 = 'Foo@Example.com'; // not valid
        $name5 = 'foo~noo@example.com'; // not valid
        $name6 = 'foo@example.net'; // not valid

        $reg = new \App\Controllers\Registration();

        $this->assertEquals(1, $reg->validEmail($name1));
        $this->assertEquals(1, $reg->validEmail($name2));
        $this->assertEquals(1, $reg->validEmail($name3));
        $this->assertEquals(0, $reg->validEmail($name4));
        $this->assertEquals(0, $reg->validEmail($name5));
        $this->assertEquals(0, $reg->validEmail($name6));

    }
}