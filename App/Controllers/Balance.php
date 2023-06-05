<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Models\TotalBalance;

/**
 * Balance controller
 * 
 * PHP version 8.1.10
 */

class Balance extends Authenticated
{
    /**
     * Show the balance page
     */
    public function showAction()
    {
        View::renderTemplate('Balance/index.html', [
            'user' => Auth::getUser()
        ]);
    }
}