<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testSave()
    {
        $user = new App\Models\User();

        $data['first_name'] = 'mohamed';
        $data['last_name'] = 'reda';
        $data['email_name'] = 'test@test.com';
        $data['phone_number'] = '962712345676';
        $data['created_at'] = $user->createdAt();
        $data['updated_at'] = $user->updatedAt();

        $status = $user->save($data);


        $this->assertTrue($status);
    }
}
