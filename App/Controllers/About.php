<?php

namespace App\Controllers;

/**
 * About page controller
 * 
 * PHP version 8.1.10
 */
 class About
 {
    /**
     * Show the index page
     */
    public function index()
    {
        echo 'Hello from the index action in the About controller!';
        echo '<p>Query string parameters: <pre>' .
        htmlspecialchars(print_r($_GET, true)) . '</pre></p>';
    }

    /**
     * Action
     */
    public function addNew()
    {
        echo 'Hello from the addNew action in the About controller!';
    }
 }