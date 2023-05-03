<?php

namespace App\Controllers;

/**
 * About page controller
 * 
 * PHP version 8.1.10
 */
 class About extends \Core\Controller
 {
    /**
     * Show the index page
     */
    public function index()
    {
        echo 'Hello from the index action in the About controller!';
        //echo '<p>Query string parameters: <pre>' .
        //htmlspecialchars(print_r($_GET, true)) . '</pre></p>';
    }

    /**
     * Show the add new page
     */
    public function addNew()
    {
        echo 'Hello from the addNew action in the About controller!';
    }

    /**
     * Show the edit page
     */
    public function edit()
    {
        echo 'Hello from the edit action in the About controller!';
        echo '<p>Route parameters: <pre>' .
        htmlspecialchars(print_r($this->route_params, true)) . '</pre></p>';
    }
 }