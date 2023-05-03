<?php 

namespace Core;

/**
 * Base controller
 * 
 * PHP version 8.1.10
 */

 abstract class Controller
 {
    /**
     * Parameters from the matched route
     */
    protected $route_params = [];

    /**
     * Class constructor
     */
    public function __construct($route_params)
    {
        $this->route_params = $route_params;
    }
}