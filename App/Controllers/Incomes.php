<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Models\Income;

/**
 * Incomes controller
 * 
 * PHP version 8.1.10
 */

class Incomes extends Authenticated
{
    /**
     * Show the incomes page
     */
    public function showAction()
    {
        View::renderTemplate('Incomes/index.html', [
            'user' => Auth::getUser()
        ]);
    }

    /**
     * 
     */
    public function addAction()
    {
        $income = new Income($_POST);

        if($income->add()) {

            echo 'gut!';

            //$this->redirect('/income/success');

        } else {

            echo 'Błąd!';

            //View::renderTemplate('Incomes/index.html', [
            //    'income'=> $income
            //]);
        }
    }
}