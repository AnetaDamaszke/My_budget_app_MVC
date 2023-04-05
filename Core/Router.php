<?php

/**
 * Router
 * 
 * PHP version 8.1.10
 */

 class Router 
 {
    /**
     * Array of routes - the routing table
     */
    protected $routes = [];

    /**
     * Parameters from the matched route
     */
    protected $params = [];

    /**
     * Add a route to the routing table
     */
    public function add($route, $params)
    {
        $this->routes[$route] = $params;
    }

    /**
     * Get all the routes from the routing table
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Match the route in the routing table
     */
    public function match($url)
    {
        foreach ($this->routes as $route => $params) {
            if ($url == $route) {
                $this->params = $params;
                return true;
            }
        }

        return false;
    }
    /**
     * Get the currently matched parameters
     */
    public function getParams()
    {
        return $this->params;
    }
 }