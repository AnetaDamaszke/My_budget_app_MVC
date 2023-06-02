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
}