<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 14/03/19
 * Time: 02:33 م
 */

namespace App\Services;


class Validation
{
    public function name($name)
    {
        $pattern = '/^[a-zA-Z]{2,20}$/i';

        return preg_match($pattern, $name);
    }

    public function email($email)
    {
        $pattern = '/^(?=.{7,20}$)[A-Za-z0-9_.-]+(\.[A-Za-z0-9_.-]+)*@[a-z]+(\.com)$/';

        return preg_match($pattern, $email);
    }

    public function phone($phone)
    {
        $pattern = "/(9)(6)(2)(7)(\\d)(\\d)(\\d)(\\d)(\\d)(\\d)(\\d)(\\d)/is";

        return preg_match($pattern, $phone);
    }

    public function code($code)
    {
        $pattern = "/^\d{4}$/";

        return preg_match($pattern, $code);
    }
}
