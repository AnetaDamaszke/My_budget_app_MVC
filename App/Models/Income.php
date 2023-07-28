<?php

namespace App\Models;

use PDO;
use \App\Auth;

/**
 * Income model
 * 
 * PHP version 8.1.10
 */

 class Income extends \Core\Model
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
     * Add new income to table in database
     */
    public function addIncome()
    {   
        $userId = Auth::getUserId();

        $categoryId = Income::getIncomeCategoryId($this->category, $userId);

        $sql = 'INSERT INTO incomes VALUES (NULL, :userid, :categoryid, :value, :date, :comment)';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt -> bindValue(':userid', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt -> bindValue(':categoryid', $categoryId, PDO::PARAM_INT);
        $stmt -> bindValue(':value', $this->incomeValue, PDO::PARAM_STR);
        $stmt -> bindValue(':date', $this->incomeDate, PDO::PARAM_STR);
        $stmt -> bindValue(':comment', $this->comment, PDO::PARAM_STR);
                   
        return $stmt->execute();
    }

    /**
     * Get income category ID from database
     */
    public static function getIncomeCategoryId($categoryName, $userId)
    {
        $sql = "SELECT id FROM incomes_category_assigned_to_users 
        WHERE category_name='$categoryName' AND user_id='$userId'";

        $db = static::getDB();
        $stmt = $db->prepare($sql); 

        $stmt->execute();

        return $stmt->fetchColumn();
    }

    /**
     * Get income category name assigned to user from database
     */
    public static function getIncomeCategoryAssignedToUser()
    {
        $userId = Auth::getUserId();

        $sql = "SELECT category_name
        FROM incomes_category_assigned_to_users 
        WHERE user_id='$userId'";

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    }

    /**
     * Get income sum in category
     */
    public static function getIncomeBalance($userId, $startDate, $endDate)
    {
        $userId = Auth::getUserId();

        $sql = 'SELECT *, SUM(amount) AS incomeSum FROM incomes, incomes_category_assigned_to_users
        WHERE incomes.income_category_assigned_to_user_id = incomes_category_assigned_to_users.id
        AND incomes.user_id = :userId AND incomes.date_of_income BETWEEN :startDate AND :endDate
        GROUP BY income_category_assigned_to_user_id ORDER BY incomeSum DESC';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':startDate', $startDate, PDO::PARAM_STR);
        $stmt->bindParam(':endDate', $endDate, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Get incomes in category
     */
    public static function getIncomesInCategory($userId, $startDate, $endDate)
    {
        $userId = Auth::getUserId();

        $sql = 'SELECT * FROM incomes
        WHERE incomes.user_id = :userId AND incomes.date_of_income BETWEEN :startDate AND :endDate';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':startDate', $startDate, PDO::PARAM_STR);
        $stmt->bindParam(':endDate', $endDate, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}