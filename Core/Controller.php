<?php 

namespace Core;

use \App\Auth;
use \App\Flash;

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

    /**
     * Magic method called when a non-existent or inaccessible method is
     * called on an object of this class. Used to execute before and after
     * filter methods on action methods.
     */
    public function __call($name, $args)
    {
        $method = $name . 'Action';

        if (method_exists($this, $method)) {
            if ($this->before() !== false) {
                call_user_func_array([$this, $method], $args);
                $this->after();
            }
        } else {
            throw new \Exception("Method $method not found in controller " . get_class($this));
        }
    }

    /**
     * Before filter - called before an action method.
     */
    protected function before() 
    {
    }

    /**
     * After filter - called after an action method.
     */
    protected function after() 
    {     
    }

    /**
     * Redirect to a different page
     */
    public function redirect($url) 
    {
        header('Location: http://' . $_SERVER['HTTP_HOST'] . $url, true, 303);
        exit;
    }

    /**
     * Rrequire the user to be logged in
     */
    public function requireLogin()
    {
        if(! Auth::getUser()) {

            Flash::addMessage('Zaloguj się, aby uzyskać dostęp do strony', Flash::INFO);
            
            Auth::rememberRequestedPage();

            $this->redirect('/login');
        }
    }
}