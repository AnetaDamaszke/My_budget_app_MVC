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
    protected function before()
    {
        parent::before();
        $this->user = Auth::getUserId();
    }

    /**
     * Show the incomes page
     */
    public function addAction()
    {
        View::renderTemplate('Incomes/index.html', [
            'user' => $this->user
        ]);
    }

    /**
     * 
     */
    public function addNewAction()
    {
        $income = new Income($_POST);

        if($income->addIncome($this->user)) {

            View::renderTemplate('Incomes/success.html');

        } else {

            View::renderTemplate('Incomes/index.html', [
                'income'=> $income
            ]);
        }
    }
}