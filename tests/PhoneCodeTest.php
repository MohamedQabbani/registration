<?php

use PHPUnit\Framework\TestCase;

class PhoneCodeTest extends TestCase
{
    public function testCode()
    {
        $phoneCode = new App\Models\PhoneCode();

        $this->assertEquals(4, strlen($phoneCode->code()));
        $this->assertIsInt($phoneCode->code());
    }

    public function testSave()
    {
        $phoneCode = new App\Models\PhoneCode();

        $data['phone'] = '962712345678';
        $data['code'] = $phoneCode->code();
        $data['sent_at'] = $phoneCode->sentAt();

        $status = $phoneCode->save($data);

        $result = $phoneCode->byPhone($data['phone']);

        $this->assertTrue($status);
        $this->assertEquals(1, count($result));
        $this->assertEquals($data['phone'], $result[0]['phone']);
        $this->assertEquals($data['code'], $result[0]['code']);
        $this->assertEquals($data['sent_at'], $result[0]['sent_at']);
    }
}
