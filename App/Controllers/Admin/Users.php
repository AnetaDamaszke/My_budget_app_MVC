<?php

namespace App\Controllers\Admin;

/**
 * User admin controller
 *
 * PHP version 8.1.10
 */

 class Users extends \Core\Controller
 {
    /**
     * Before filter
     */
    protected function before()
    {

    }

    /**
     * Show the index page
     */
    public function indexAction()
    {
        echo 'User admin index';
    }
 }