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
    public function addAction()
    {
        View::renderTemplate('Incomes/index.html', [
            'user' => Auth::getUser()
        ]);
    }

    /**
     * 
     */
    public function addNewAction()
    {
        $income = new Income($_POST);   

        if($income->addIncome()) {

            View::renderTemplate('Incomes/success.html');

        } else {

            View::renderTemplate('Incomes/index.html', [
                'income'=> $income
            ]);
        }
    }
}