<?php

namespace App\Controllers;

/**
 * Home controller
 * 
 * PHP version 8.1.10
 */
 class Home extends \Core\Controller
 {
    /**
     * Show the index page
     */
    public function index()
    {
        echo 'Hello from the index action in the Home controller!';
    }
 }