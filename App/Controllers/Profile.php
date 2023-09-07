<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Flash;
use \App\Models\User;

/**
 * Profile controller
 * 
 * PHP version 8.1.10
 */


class Profile extends Authenticated
{
    protected function before()
    {
        parent::before();
        $this->user = Auth::getUser();
    }
    
    /**
     * Show the profile
     */
    public function showAction() 
    {
        View::renderTemplate('Profile/show.html', [
            'user' => $this->user
        ]);
    }

    public function editAction()
    {
        View::renderTemplate('Profile/edit.html', [
            'user' => $this->user
        ]);
    }

    public function updateAction()
    {

        if ($this->user->updateProfile($_POST)) {

            Flash::addMessage('Zmiany zostały zapisane');
            $this->redirect('/profile/show');
        } else {
            View::renderTemplate('Profile/edit.html', [
                'user' => $this->user
            ]);
        }
    }

    public function deleteUserAction()
    {
        View::renderTemplate('Profile/delete-user.html', [
            'user' => $this->user
        ]);
    }

    public function deleteUserFromaDataBaseAction()
    {
        if ($this->user->deleteUserFromaDataBase()) {

            Flash::addMessage('Użytkownik został usunięty');
            $this->redirect('/');
            
        } else {
            View::renderTemplate('Profile/delete-user.html', [
                'user' => $this->user
            ]);
        }
    }

    public function incomesAction()
    {
        View::renderTemplate('Profile/incomes.html', [
            'user' => $this->user
        ]);
    }

    public function addIncomesCategoryAction()
    {
        if ($this->user->addNewIncomesCategory($_POST['category'])) {

            Flash::addMessage('Kategoria została dodana');
            $this->redirect('/profile/show');
            
        } else {
            View::renderTemplate('Profile/incomes.html', [
                'user' => $this->user
            ]);
        }
    }

    public function expensesAction()
    {
        View::renderTemplate('Profile/expenses.html', [
            'user' => $this->user
        ]);
    }

    public function addExpensesCategoryAction()
    {

        if ($this->user->addNewExpensesCategory($_POST['category'])) {

            Flash::addMessage('Kategoria została dodana');
            $this->redirect('/profile/show');
            
        } else {
            View::renderTemplate('Profile/expenses.html', [
                'user' => $this->user
            ]);
        }
    }

    public function deleteInCatAction()
    {
        $categoryName = $_GET['name'];
        
        if(User::isIncomesTableEmpty($categoryName) > 0)
        {
            Flash::addMessage('UWAGA: W tej kategorii masz zapisane przychody. 
            Usunięcie kategorii spowoduje usunięcie tych przychodów z bazy danych!', Flash::WARNING);   
        }

        View::renderTemplate('Profile/delete-incomes-category.html', [
            'user' => $this->user,
            'name' => $categoryName
        ]);
        
    }

    public function deleteIncomesCategoryAction()
    {
        if ($this->user->deleteIncomesCategory()) {

            Flash::addMessage('Kategoria została usunięta');
            $this->redirect('/profile/show');

        } else {
            View::renderTemplate('Profile/delete-incomes-category.html', [
                'user' => $this->user
            ]);
        }
    }

    public function deleteExCatAction()
    {
        $categoryName = $_GET['name'];
        
        if(User::isExpensesTableEmpty($categoryName) > 0)
        {
            Flash::addMessage('UWAGA: W tej kategorii masz zapisane wydatki.
            Usunięcie kategorii spowoduje usunięcie tych wydatków z bazy danych!', Flash::WARNING);   
        }

        View::renderTemplate('Profile/delete-expenses-category.html', [
            'user' => $this->user,
            'name' => $categoryName
        ]);
    }

    public function deleteExpensesCategoryAction()
    {
        if ($this->user->deleteExpensesCategory()) {

            Flash::addMessage('Kategoria została usunięta');
            $this->redirect('/profile/show');

        } else {
            View::renderTemplate('Profile/delete-expenses-category.html', [
                'user' => $this->user
            ]);
        }
    }

    public function deletePayMetAction()
    {
        $paymentMethod = $_GET['name'];

        if(User::isPaymentMethodTableEmpty($paymentMethod) > 0)
        {
            Flash::addMessage('UWAGA: W tej metody płatności masz przypisane wydatki.
            Usunięcie kategorii spowoduje usunięcie tych wydatków z bazy danych!', Flash::WARNING);   
        }

        View::renderTemplate('Profile/delete-payment-method.html', [
            'user' => $this->user,
            'name' => $paymentMethod
        ]);
    }

    public function deletePaymentsMethodAction()
    {
        if ($this->user->deletePaymentsMethod()) {

            Flash::addMessage('Metoda płatności została usunięta');
            $this->redirect('/profile/show');

        } else {
            View::renderTemplate('Profile/delete-expenses-category.html', [
                'user' => $this->user
            ]);
        }
    }

    public function editInCatAction()
    {
        $categoryName = $_GET['name'];

        View::renderTemplate('Profile/edit-incomes-category.html', [
            'user' => $this->user,
            'name' => $categoryName
        ]);
    }

    public function editIncomesCategoryAction()
    {
        $categoryName = $_GET['name'];

        if ($this->user->editIncomesCategory($categoryName, $_POST['input'])) {

            Flash::addMessage('Nazwa kategorii została edytowana');
            $this->redirect('/profile/show');

        } else {
            View::renderTemplate('Profile/edit-incomes-category.html', [
                'user' => $this->user
            ]);
        }
    }

    public function editExCatAction()
    {
        $categoryName = $_GET['name'];

        View::renderTemplate('Profile/edit-expenses-category.html', [
            'user' => $this->user,
            'name' => $categoryName
        ]);
    }

    public function editExpensesCategoryAction()
    {
        $categoryName = $_GET['name'];

        if ($this->user->editExpensesCategory($categoryName, $_POST['input'])) {

            Flash::addMessage('Nazwa kategorii została edytowana');
            $this->redirect('/profile/show');

        } else {
            View::renderTemplate('Profile/edit-expenses-category.html', [
                'user' => $this->user
            ]);
        }
    }

    public function paymentsAction()
    {
        View::renderTemplate('Profile/payments.html', [
            'user' => $this->user
        ]);
    }

    public function addPaymentsMethodAction()
    {
        if ($this->user->addPaymentsMethod($_POST['name'])) {

            Flash::addMessage('Metoda płatności została dodana');
            $this->redirect('/profile/show');
            
        } else {
            View::renderTemplate('Profile/payments.html', [
                'user' => $this->user
            ]);
        }
    }

    public function editPayMethodAction()
    {
        $paymentsMethodName = $_GET['name'];

        View::renderTemplate('Profile/edit-payment-method.html', [
            'user' => $this->user,
            'name' => $paymentsMethodName
        ]);
    }

    public function editPaymentsMethodAction()
    {
        $paymentsMethodName = $_GET['name'];

        if ($this->user->editPaymentsMethod($paymentsMethodName, $_POST['input'])) {

            Flash::addMessage('Nazwa kategorii została edytowana');
            $this->redirect('/profile/show');

        } else {
            View::renderTemplate('Profile/edit-payment-method.html', [
                'user' => $this->user
            ]);
        }
    }
    
}