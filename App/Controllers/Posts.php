<?php

namespace App\Controllers;

use \Core\View;
use App\Models\Post;

/**
 * About page controller
 * 
 * PHP version 8.1.10
 */
 class Posts extends \Core\Controller
 {
    /**
     * Show the index page
     */
    protected function indexAction()
    {
        $posts = Post::getAll();

        View::renderTemplate('Posts/index.html', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the add new page
     */
    protected function addNewAction()
    {
        echo 'Hello from the addNew action in the About controller!';
    }

    /**
     * Show the edit page
     */
    protected function editAction()
    {
        echo 'Hello from the edit action in the About controller!';
        echo '<p>Route parameters: <pre>' .
        htmlspecialchars(print_r($this->route_params, true)) . '</pre></p>';
    }
 }