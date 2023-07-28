<?php

namespace App\Models;

use PDO;
use \App\Auth;

/**
 * Expense model
 * 
 * PHP version 8.1.10
 */

 class Expense extends \Core\Model
 {

    /**
     * Class constructor
     */
    public function __construct($data = [])
    {
        foreach($data as $key => $value) {
            $this->$key = $value;
        };
    }

    /**
     * Add new expense to table in database
     */
    public function addExpense()
    {   
        $userId = Auth::getUserId();

        $categoryId = Expense::getExpenseCategoryId($this->category, $userId);
        $paymentMethodId = Expense::getPaymentMethodId($this->payment, $userId);

        $sql = 'INSERT INTO expenses VALUES (NULL, :userid, :categoryid, :payment, :value, :date, :comment)';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt -> bindValue(':userid', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt -> bindValue(':categoryid', $categoryId, PDO::PARAM_INT);
        $stmt -> bindValue(':payment', $paymentMethodId, PDO::PARAM_INT);
        $stmt -> bindValue(':value', $this->expenseValue, PDO::PARAM_STR);
        $stmt -> bindValue(':date', $this->expenseDate, PDO::PARAM_STR);
        $stmt -> bindValue(':comment', $this->comment, PDO::PARAM_STR);
                   
        return $stmt->execute();
    }

    /**
     * Get expense category ID from database
     */
    public static function getExpenseCategoryId($categoryName, $userId)
    {
        $sql = "SELECT id FROM expenses_category_assigned_to_users 
        WHERE category_name='$categoryName' AND user_id='$userId'";

        $db = static::getDB();
        $stmt = $db->prepare($sql); 

        $stmt->execute();;

        return $stmt->fetchColumn();
    }

    /**
     * Get payment method ID from database
     */
    public static function getPaymentMethodId($methodName, $userId)
    {
        $sql = "SELECT id FROM payment_methods_assigned_to_users 
        WHERE name='$methodName' AND user_id='$userId'";

        $db = static::getDB();
        $stmt = $db->prepare($sql); 

        $stmt->execute();;

        return $stmt->fetchColumn();
    }

    /**
     * Get expense category name assigned to user from database
     */
    public static function getExpenseCategoryAssignedToUserName()
    {
        $userId = Auth::getUserId();

        $sql = "SELECT category_name
        FROM expenses_category_assigned_to_users 
        WHERE user_id='$userId'";

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    }

    /**
     * Get payment methods assigned to user from database
     */
    public static function getPaymentMethodsAssignedToUserName()
    {
        $userId = Auth::getUserId();

        $sql = "SELECT name
        FROM payment_methods_assigned_to_users 
        WHERE user_id='$userId'";

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    }

    /**
     * Get expense sum in category
     */
    public static function getExpenseBalance($userId, $startDate, $endDate)
    {
        $userId = Auth::getUserId();

        $sql = 'SELECT *, SUM(amount) AS expenseSum FROM expenses, expenses_category_assigned_to_users
        WHERE expenses.expense_category_assigned_to_user_id = expenses_category_assigned_to_users.id
        AND expenses.user_id = :userId AND expenses.date_of_expense BETWEEN :startDate AND :endDate
        GROUP BY expense_category_assigned_to_user_id ORDER BY expenseSum DESC';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':startDate', $startDate, PDO::PARAM_STR);
        $stmt->bindParam(':endDate', $endDate, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Get expenses in category
     */
    public static function getExpensesInCategory($userId, $startDate, $endDate)
    {
        $userId = Auth::getUserId();

        $sql = 'SELECT * FROM expenses
        WHERE expenses.user_id = :userId AND expenses.date_of_expense BETWEEN :startDate AND :endDate';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':startDate', $startDate, PDO::PARAM_STR);
        $stmt->bindParam(':endDate', $endDate, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Get expense data for pie chart
     */
    public static function getExpenseData($userId, $startDate, $endDate)
    {
        $userId = Auth::getUserId();

        $sql = 'SELECT SUM(amount) AS expenseSum, category_name FROM expenses, expenses_category_assigned_to_users
        WHERE expenses.expense_category_assigned_to_user_id = expenses_category_assigned_to_users.id
        AND expenses.user_id = :userId AND expenses.date_of_expense BETWEEN :startDate AND :endDate
        GROUP BY expense_category_assigned_to_user_id ORDER BY expenseSum DESC';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':startDate', $startDate, PDO::PARAM_STR);
        $stmt->bindParam(':endDate', $endDate, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}