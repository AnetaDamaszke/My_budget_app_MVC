<?php

namespace App\Models;

use PDO;

/**
 * User model
 * 
 * PHP version 8.1.10
 */

 class User extends \Core\Model
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
     * Save the user model with the current property values
     */

    public function save()
    {
        $password_hash = password_hash($this->password, PASSWORD_DEFAULT);

        $sql = 'INSERT INTO users (name, email, password_hash)
                VALUES (:name, :email, :password_hash)';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);

        $stmt->execute();
    }
}
