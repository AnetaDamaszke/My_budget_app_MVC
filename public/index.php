<?php 

/**
 * Front controller
 * 
 * PHP version 8.1.10
 */

 //echo 'Requested URL = "' . $_SERVER['QUERY_STRING'] .'"';

 /**
  * Routing
  */

  require '../Core/Router.php';

  $router = new Router();

  //Add the routes
  $router->add('', ['controller' => 'Home', 'action' => 'index']);
  $router->add('about', ['controller' => 'About', 'action' => 'index']);

  //Display the routing table
  echo '<pre>';
  var_dump($router->getRoutes());
  echo '</pre>';