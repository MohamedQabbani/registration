<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 13/03/19
 * Time: 09:22 م
 */

namespace App\Controllers;

use App\Models\PhoneCode;
use App\Models\User;
use App\Services\SMS;

class Registration
{
    public function start()
    {
        $errors = [];
        $first_name = '';
        $last_name = '';
        $email_name = '';
        $phone_number = '';
        $verification_code = '';

        if (isset($_POST['register'])) {
            $validation = new \App\Services\Validation();

            $first_name = $_POST['first_name'];
            if (!$validation->name($first_name)) {
                $errors['first_name'] = 'First name is not valid.';
            }

            $last_name = $_POST['last_name'];
            if (!$validation->name($last_name)) {
                $errors['last_name'] = 'Last name is not valid.';
            }

            $email_name = $_POST['email_name'];
            if (!$validation->email($email_name)) {
                $errors['email_name'] = 'Email name is not valid.';
            }

            $phone_number = $_POST['phone_number'];
            if (!$validation->phone($phone_number)) {
                $errors['phone_number'] = 'Phone number is not valid.';
            }

            $verification_code = $_POST['verification_code'];
            if (!$validation->code($verification_code)) {
                $errors['verification_code'] = 'Verification code is not valid.';
            }

            if (empty($errors)) {
                $phoneCode = new PhoneCode();
                $result = $phoneCode->byPhone($phone_number);
                if (count($result) > 0) {
                    if ($verification_code != $result[0]['code']) {
                        $errors['verification_code'] = 'Verification code is not true.';
                    } else {
                        // save user
                        if ($this->saveUser($first_name, $last_name, $email_name, $phone_number)) {
                            return require_once 'app/Views/success.php';
                        } else {
                            return require_once 'app/Views/fail.php';
                        }
                    }
                } else {
                    $errors['verification_code'] = 'You must verify phone first.';
                }
            }
        }

        if (isset($_POST['verify_phone']) && isset($_POST['access_token'])) {
            $this->sendCode();
        }

        require_once 'app/Views/registration.php';
    }

    /**
     * @param $data
     */
    public function sendCode()
    {
        $is_sent = false;
        if ('123456' == $_POST['access_token'] && !empty($_POST['verify_phone'])) {
            $phoneCode = new PhoneCode();

            $data['phone'] = $_POST['verify_phone'];
            $data['code'] = $phoneCode->code();
            $data['sent_at'] = $phoneCode->sentAt();

            if ($phoneCode->save($data)) {
                $sms = new SMS();
                $data = [
                    'AppSid' => 'SpRpFe5w7P_5XNxBF8BSnuk6PxXTc0',
//                    'Recipient' => $data['phone'],
                    'Recipient' => '966541111111',
                    'Body' => 'your verification is ' . $data['code'],
                    'SenderID' => 'test sender',
                ];

                $response = json_decode($sms->send($data), 1);
                if ('true' == $response['success']) {
                    $is_sent = true;
                }
            }
        } else {
            $is_sent = false;
        }

        if ($is_sent) {
            echo 'Code sent successfully';
            die;
        } else {
            echo 'Can not send code';
            die;
        }
    }

    /**
     * @param $first_name
     * @param $data
     * @param $last_name
     * @param $email_name
     * @param $phone_number
     * @return bool
     */
    public function saveUser($first_name, $last_name, $email_name, $phone_number)
    {
        $user = new User();

        $data['first_name'] = $first_name;
        $data['last_name'] = $last_name;
        $data['email_name'] = $email_name;
        $data['phone_number'] = $phone_number;
        $data['created_at'] = $user->createdAt();
        $data['updated_at'] = $user->updatedAt();

        return $user->save($data);
    }
}
