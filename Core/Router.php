<?php

/**
 * Router
 * 
 * PHP version 8.1.10
 */

 class Router 
 {
    //Array of routes
    protected $routes = [];

    //Add a route to the routing table
    public function add($route, $params)
    {
        $this->routes[$route] = $params;
    }

    //Get all the routes from the routing table
    public function getRoutes()
    {
        return $this->routes;
    }
 }