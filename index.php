<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 13/03/19
 * Time: 09:07 م
 */


require __DIR__ . '/vendor/autoload.php';

use App\Controllers\Registration;

$registration = new Registration();

$registration->start();