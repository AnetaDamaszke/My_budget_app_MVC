<?php

namespace App\Controllers;

use \Core\View;

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
        //echo 'Hello from the index action in the Home controller!';
        View::render('Home/index.php');
    }
 }