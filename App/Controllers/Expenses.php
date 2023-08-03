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

    protected function before()
    {
        parent::before();
        $this->user = Auth::getUserId();
    }

    /**
     * Show the expenses page
     */
    public function addAction()
    {
        View::renderTemplate('Expenses/index.html', [
            'user' => $this->user
        ]);
    }

    /**
     * Add new expense
     */
    public function addNewAction()
    {
        $expense = new Expense($_POST);   

        if($expense->addExpense($this->user)) {

            View::renderTemplate('Expenses/success.html');

        } else {

            View::renderTemplate('Expenses/index.html', [
                'expense'=> $expense
            ]);
        }
    }
}