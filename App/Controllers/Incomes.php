<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Models\Income;
use \App\Models\User;

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

        $name = $income->getIncomeCategoryAssignedToUserName();

        foreach($name as $i) 
        {
            echo $i;
        }
        

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