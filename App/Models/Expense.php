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
}