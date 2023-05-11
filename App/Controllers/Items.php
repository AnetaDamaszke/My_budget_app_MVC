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
     * Require to be authenticated before giving access to all methods in the cntroller
     */
    protected function before()
    {
        $this->requireLogin();
    }

    /**
     * Item index
     */
    public function indexAction()
    {
        View::renderTemplate('Items/index.html');
    }

 }