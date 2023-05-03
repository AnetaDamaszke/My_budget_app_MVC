<?php

namespace Core;

/**
 * View
 * 
 * PHP version 8.1.10
 */

 class View
 {
    /**
     * Render a view file
     */
    public static function render($view)
    {   
        $file = "../App/Views/$view"; // relative to Core directory

        if (is_readable($file)) {
            require $file;
        } else {
            echo "$file not found";
        }
    }
 }