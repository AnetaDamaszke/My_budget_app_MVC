<?php

namespace App;

use App\Models\User;

/**
 * Authentication
 * 
 * PHP version 8.1.10
 */

 class Auth
 {
    /**
     * Login the user
     */
    public static function login($user)
    {
        session_regenerate_id(true);

        $_SESSION['user_id'] = $user->id;
    }

    /**
     * Logut the user
     */
    public static function logout()
    {
        //Unset all of them session variable
        $_SESSION = [];

        //Delete the session cookie
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        //Finally destroy the session
        session_destroy();
    }

    /**
     * Remember the originally requested page in the session
     */
    public static function rememberRequestedPage()
    {
        $_SESSION['return_to'] = $_SERVER['REQUEST_URI'];
    }

    /**
     * Get the originally equested page to return to after login
     */
    public static function getReturnToPage()
    {
        return $_SESSION['return_to'] ?? '/';
    }

    /**
     * Get the current logged in user
     */
    public static function getUser()
    {
        if (isset($_SESSION['user_id'])) {

            return User::findByID($_SESSION['user_id']);
        }
    }
 }