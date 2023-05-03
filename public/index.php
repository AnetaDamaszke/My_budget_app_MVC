<?php 

/**
 * Front controller
 * 
 * PHP version 8.1.10
 */

/** 
 * Composer
 */
 require dirname(__DIR__)  . '/vendor/autoload.php';

 /**
  * Routing
  */

  $router = new Core\Router();
 
  //Add the routes
  $router->add('', ['controller' => 'Home', 'action' => 'index']);
  $router->add('{controller}/{action}');
  $router->add('{controller}/{id:\d+}/{action}');
  $router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);

  /*
  //Display the routing table
  

  //Match the requested route
  $url = $_SERVER['QUERY_STRING'];

  if($router->match($url)) {
    echo '<pre>';
    echo htmlspecialchars(print_r($router->getRoutes(), true));
    var_dump($router->getParams());
    echo '</pre>';
  } else {
    echo "No route found for URL '$url'";
  }
  */

  $router->dispatch($_SERVER['QUERY_STRING']);