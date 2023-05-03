<?php

namespace Core;

use PDO;

/**
 * Base model
 * 
 * PHP version 8.1.10
 */

 abstract class Model
 {
    /**
     * Get the PDO database connection
     */
    protected static function getDB()
    {
        static $db = null;

        if ($db === null) {
            $host = 'localhost';
            $dbname = 'mvc';
            $username = 'root';
            $password = '';

            try {
                $db = new PDO("mysql:host=$host; dbname=$dbname; charset=utf8", $username, $password);

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        return $db;
    }
 }
 