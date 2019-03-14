<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 13/03/19
 * Time: 09:22 م
 */

namespace App\Controllers;
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
                $errors['first_name'] = $first_name;
            }

            $last_name = $_POST['last_name'];
            if (!$validation->name($last_name)) {
                $errors['last_name'] = $last_name;
            }

            $email_name = $_POST['email_name'];
            if (!$validation->email($email_name)) {
                $errors['email_name'] = $email_name;
            }

            $phone_number = $_POST['phone_number'];
            if (!$validation->phone($phone_number)) {
                $errors['phone_number'] = $phone_number;
            }

            $verification_code = $_POST['verification_code'];
            if (!$validation->code($verification_code)) {
                $errors['verification_code'] = $verification_code;
            }
        }

        require_once 'app/Views/registration.php';
    }
}
