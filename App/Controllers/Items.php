<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;

/**
 * Items controller
 * 
 * PHP version 8.1.10
 */

 class Items extends Authenticated
 {
    /**
     * Item index
     */
    public function indexAction()
    {
        View::renderTemplate('Items/index.html');
    }

 }