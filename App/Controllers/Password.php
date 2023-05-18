<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

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

     /**
      * Send the password reset link to the supplied email
      */
     public function requestResetAction()
     {
        User::sendPasswordReset($_POST['email']);

        View::renderTemplate('Password/reset_requested.html');
     }

     /**
      * Show the reset password form
      */
     public function resetAction()
     {
        $token = $this->route_params['token'];

        echo $token;

        $user = User::findByPasswordReset($token);

        if($user) {

            View::renderTemplate('Password/reset.html');

        } else {
            echo "password reset token invalid";
        }
     }
 }