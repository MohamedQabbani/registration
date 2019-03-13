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
        require_once 'app/Views/registration.php';
    }

    // Validation methods
    public function validName($name)
    {
        $pattern = '/^[a-zA-Z]{2,20}$/i';

        return preg_match($pattern, $name);
    }

    public function validEmail($email)
    {
        $pattern = '/^((?:[A-Za-z0-9_.-][A-Za-z0-9_.-]+))(@)([a-z]+)(\\.)(com)$/';

        return preg_match($pattern, $email);
    }
}