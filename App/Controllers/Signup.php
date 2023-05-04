<?php

namespace App\Controllers;

use \Core\View;

/**
 * Signup controller
 * 
 * PHP version 8.1.10
 */

class Signup extends \Core\Controller
{
    /**
     * Show the signup page
     */
    public function newAction()
    {
        View::renderTemplate('Signup/new.html');
    }
}