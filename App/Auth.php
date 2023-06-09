<?php

namespace App;

use App\Models\User;
use App\Models\RememberedLogin;

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
    public static function login($user, $remember_me)
    {
        session_regenerate_id(true);

        $_SESSION['user_id'] = $user->id;

        if ($remember_me) {

            if ($user->rememberLogin()) {

                setcookie('remember_me', $user->remember_token, $user->expiry_timestamp, '/');
            }
        }
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

        static::forgetLogin();
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
        } else {

            return static::loginFromRememberCookie();
        }
    }

    /**
     * Login the user a remembered login cookie
     */
    protected static function loginFromRememberCookie()
    {
        $cookie = $_COOKIE['remember_me'] ?? false;

        if ($cookie) {

            $remembered_login = RememberedLogin::findByToken($cookie);

            if ($remembered_login && ! $remembered_login->hasExpired()) {

                $user = $remembered_login->getUser();

                static::login($user, false);

                return $user;
            }
        }
    }

    /**
     * Forget the remembered login, if present
     */
    protected static function forgetLogin()
    {
        $cookie = $_COOKIE['remember_me'] ?? false;

        if ($cookie) {

            $remembered_login = RememberedLogin::findByToken($cookie);

            if ($remembered_login) {

                $remembered_login->delete();
            }

            setcookie('remember_me', '', time() - 3600, '/');
        }
    }

    /**
     * Get the current user id
     */
    public static function getUserId()
    {
        if (isset($_SESSION['user_id'])) {
            return ($_SESSION['user_id']);
        } else {
            return static::loginFromRememberCookie();
        }
    }
 }