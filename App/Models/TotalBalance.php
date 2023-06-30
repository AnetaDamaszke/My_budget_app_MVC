<?php

namespace App\Models;

use PDO;
use \App\Auth;

/**
 * Balance model
 * 
 * PHP version 8.1.10
 */

 class TotalBalance extends \Core\Model
 {
    /**
     * Calculate the total sum of all incomes
     */
    public static function totalIncomesSum($date1, $date2) {

        $userId = $_SESSION['user_id'];

        $sql = "SELECT SUM(amount) FROM incomes WHERE user_id='$userId' 
        AND date_of_income BETWEEN '$date1' AND '$date2'";
        
        $db = static::getDB();
        $stmt = $db->prepare($sql); 

        $stmt->execute();

        $totalIncomes = $stmt->fetchColumn();

        return $totalIncomes;
    }

    /**
     * Calculate the total sum of all expenses
     */
    public static function totalExpensesSum($date1, $date2) {

        $userId = $_SESSION['user_id'];

        $sql = "SELECT SUM(amount) FROM expenses WHERE user_id='$userId' AND date_of_expense
         BETWEEN '$date1' AND '$date2'";
        
        $db = static::getDB();
        $stmt = $db->prepare($sql); 

        $stmt->execute();

        $totalExpenses = $stmt->fetchColumn();

        return $totalExpenses;
    }

    /**
     * Getting user income category
     */
    public static function getUserIncomesCategory() {

        $incomeCategoryId = $category->id;

        $sql = "SELECT * FROM incomes 
        WHERE income_category_assigned_to_user_id='$incomeCategoryId' 
        AND date_of_income BETWEEN '$date1' AND '$date2'";

        $db = static::getDB();
        $stmt = $db->prepare($sql); 
        $stmt->execute();

        $userIncomesCategory = $stmt->fetchColumn();

        return $userIncomesCategory;
    }

    /**
     * Sum incomes in category
     */
    public static function sumIncomesInCategory($date1, $date2, $incomeCategoryId) {

        $sql = "SELECT SUM(amount) FROM incomes WHERE income_category_assigned_to_user_id='$incomeCategoryId' 
        AND date_of_income BETWEEN '$date1' AND '$date2'";

        $db = static::getDB();
        $stmt = $db->prepare($sql); 
        $stmt->execute();

        $sumIncomesInCategory = $stmt->fetchColumn();

        return $sumIncomesInCategory;
    }

    /**
     * Get incomes
     */
    public static function getIncome() {

        $userId = Auth::getUserId();

        $sql = "SELECT *
        FROM incomes 
        WHERE user_id='$userId'";

        $db = static::getDB();
        $stmt = $db->prepare($sql); 
        $stmt->execute();

        $incomes = $stmt->fetchAll();

        return $incomes;
    }
   
 }