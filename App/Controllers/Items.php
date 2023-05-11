<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;

/**
 * Items controller
 * 
 * PHP version 8.1.10
 */

 class Items extends \Core\Controller
 {
    /**
     * Item index
     */

    public function indexAction()
    {
        if(! Auth::isLoggedIn()) {
            exit("access denied");
        }

        View::renderTemplate('Items/index.html');
    }

 }