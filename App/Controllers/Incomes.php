<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;

/**
 * Incomes controller
 * 
 * PHP version 8.1.10
 */

class Incomes extends Authenticated
{
    /**
     * Show the incomes page
     */
    public function showAction()
    {
        View::renderTemplate('Incomes/index.html', [
            'user' => Auth::getUser()
        ]);
    }
}