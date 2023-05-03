<?php 

/**
 * Front controller
 * 
 * PHP version 8.1.10
 */

 // Require the controller class
 // require '../App/Controllers/About.php';


 /**
  * Autoloader
  */
 spl_autoload_register(function ($class) {
    $root = dirname(__DIR__);   // get the parent directory
    $file = $root . '/' . str_replace('\\', '/', $class). '.php';
    if (is_readable($file)) {
      require $root . '/' . str_replace('\\', '/', $class). '.php';
    }
  });

 /**
  * Routing
  */

  //require '../Core/Router.php';

  $router = new Core\Router();
 
  //Add the routes
  $router->add('', ['controller' => 'Home', 'action' => 'index']);
  $router->add('about', ['controller' => 'About', 'action' => 'index']);
  $router->add('{controller}/{action}');
  $router->add('{controller}/{id:\d+}/{action}');
  $router->add('admin/{action}/{controller}');

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