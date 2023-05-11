<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;
use \App\Auth;
use \App\Flash;

/**
 * Login controller
 * 
 * PHP version 8.1.10
 */

 class Login extends \Core\Controller
 {
    /**
     * Show the login page
     */
    public function newAction()
    {
        View::renderTemplate('Login/new.html');
    }

    /**
     * Log in a user
     */
    public function createAction()
    {
        $user = User::authenticate($_POST['email'], $_POST['password']);

        if ($user) {

            Auth::login($user);

            Flash::addMessage('Logowanie zakończone sukcesem');

            $this->redirect(Auth::getReturnToPage());

        } else {

            Flash::addMessage('Logowanie nieudane, spróbuj ponownie', Flash::WARNING);

            View::renderTemplate('Login/new.html', [
                'email' => $_POST['email']
            ]);
        }
    }

    /**
     * Log out a user
     */
    public function destroyAction()
    {
        Auth::logout();

        Flash::addMessage('Wylogowano z powodzeniem');

        $this->redirect('/login/show-logout-message');
    }

    /**
     * Show a "logged out" flash message
     */
    public function showLogoutMessageAction()
    {
        Flash::addMessage('Wylogowano z powodzeniem');

        $this->redirect('/');
    }

 } 