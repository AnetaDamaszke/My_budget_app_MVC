<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Models\Income;
use \App\Models\Expense;
use \App\DateValidator;

/**
 * Balance controller
 * 
 * PHP version 8.1.10
 */

class Balance extends Authenticated
{
    protected function before()
    {
        parent::before();
        $this->user = Auth::getUser();
    }

    protected function after()
    {
        //unset($_SESSION['title']);
    }

    /**
     * Choose dates page
     */
    public function newAction()
    {
        View::renderTemplate('Balance/new.html', [
            'user' => $this->user,
            //'active' => 'balance'
        ]);
    }

    /**
     * Show the balance page with choosing dates
     */
    public function showAction()
    {
        if(!isset($_POST['dates'])) {
            $this->redirect('/balance/new');
            exit;
        }

        $userId = $this->user->id;

        $dates = $_POST['dates'];

        $dateRange = DateValidator::validateDate($dates);

        if (empty($dateRange)) {
            $this->redirect('/balance/new');
            exit;
        }

        $startDate = $dateRange['start_date'];
        $endDate = $dateRange['end_date'];

        $incomeBalance = Income::getIncomeBalance($userId, $startDate, $endDate);
        $expenseBalance = Expense::getExpenseBalance($userId, $startDate, $endDate);
        $incomesInCategory = Income::getIncomesInCategory($userId, $startDate, $endDate);
        $expensesInCategory = Expense::getExpensesInCategory($userId, $startDate, $endDate);

        $dataChart[] = Expense::getExpenseData($userId, $startDate, $endDate);

        View::renderTemplate('Balance/index.html', [
                'user' => $this->user,
                'date1' => $startDate,
                'date2' => $endDate,
                'income_balance' => $incomeBalance,
                'incomes_in_category' => $incomesInCategory,
                'expense_balance' => $expenseBalance,
                'expenses_in_category' => $expensesInCategory,
                'dataChart' => $dataChart
            ]);
    }
}