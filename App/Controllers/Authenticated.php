<?php

namespace App\Controllers;

/**
 * Authenticated base controller
 * 
 * PHP version 8.1.10
 */

 abstract class Authenticated extends \Core\Controller
 {
    /**
     * Require to be authenticated before giving access to all methods in the cntroller
     */
    protected function before()
    {
        $this->requireLogin(); 
    }
 }