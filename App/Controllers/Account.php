<?php

namespace App\Controllers;

use \App\Models\User;

/**
 * Account controller
 * 
 * PHP version 8.1.10
 */


class Account extends \Core\Controller
{
    public function validateEmailAction() 
    {
        $is_valid = ! User::emailExists($_GET['email'], $_GET['ignore_id'] ?? null);

        header('Content-Type: appliction/json');
        echo json_encode($is_valid);
    }
}