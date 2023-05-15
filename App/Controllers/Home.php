<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Mail;

/**
 * Home controller
 * 
 * PHP version 8.1.10
 */
 class Home extends \Core\Controller
 {
    /**
     * Before filter
     *
     */
    protected function before()
    {
        //echo "(before) ";
        //return false;
    }

    /**
     * After filter
     *
     */
    protected function after()
    {
        //echo " (after)";
    }

    /**
     * Show the index page
     */
    protected function indexAction()
    {
        View::renderTemplate('Home/index.html');
    }
 }