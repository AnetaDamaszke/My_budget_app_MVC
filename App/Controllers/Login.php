<?php

namespace App\Controllers;

use \Core\View;

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
 }