<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

/**
 * Login controller
 * 
 * PHP version 8.1.10
 */

 class Login extends \Core\Controller
 {
    /**
     * Show the login page
     */
    public function newAction()
    {
        View::renderTemplate('Login/new.html');
    }

    /**
     * Log in a user
     */
    public function createAction()
    {
        $user = User::findByEmail($_POST['email']);

        var_dump($user);
    }


 }