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
    public function add($route, $params=[])
    {
        // Convert the route to a regular expression: escape forward slashes
        $route = preg_replace('/\//', '\\/', $route);

        //Convert variables e.g. {contreller}
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        //Convert variables with custom regular expression e.g. {id: \d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        //Add start and end delimiters, and case insensitive flag
        $route = '/^' .$route . '$/i';

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
        /*
        foreach ($this->routes as $route => $params) {
            if ($url == $route) {
                $this->params = $params;
                return true;
            }
        }
        */

        //Match to the fixed URL formt /controller/action
        //$reg_exp = "/^(?P<controler>[a-z-]+)\/(?P<action>[a-z-]+)$/";

        foreach ($this->routes as $route => $params) {
            if(preg_match($route, $url, $matches)) {
                // Get named capure gropu values
                //$params = [];

                foreach ($matches as $key => $match) {
                    if(is_string($key)) {
                        $params[$key] = $match;
                    }
                }

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