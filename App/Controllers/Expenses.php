<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Models\Expense;

/**
 * Expenses controller
 * 
 * PHP version 8.1.10
 */

class Expenses extends Authenticated
{
    /**
     * Show the expenses page
     */
    public function addAction()
    {
        View::renderTemplate('Expenses/index.html', [
            'user' => Auth::getUser()
        ]);
    }

    /**
     * 
     */
    public function addNewAction()
    {
        $expense = new Expense($_POST);   

        if($expense->addExpense()) {

            View::renderTemplate('Expenses/success.html');

        } else {

            View::renderTemplate('Expenses/index.html', [
                'expense'=> $expense
            ]);
        }
    }
}