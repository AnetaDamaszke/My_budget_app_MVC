<?php

namespace App\Controllers;

use \Core\View;
//use \App\Models\User;

/**
 * Password controller
 * 
 * PHP version 8.1.10
 */

 class Password extends \Core\Controller
 {
    /**
     * Show the forgotten password page
     */
     public function forgotAction()
     {
         View::renderTemplate('Password/forgot.html');
     }
 }