<?php

namespace App;

/**
 * Flash messages
 * 
 * PHP version 8.1.10
 */

 class Flash
 {
    /**
     * Flash message types
     */
    const SUCCESS = 'success';
    const INFO = 'info';
    const WARNING = 'warning';

    /**
     * Add a message
     */
    public static function addMessage($message, $type = 'success')
    {
        if(! isset($_SESSION['flash_notifications'])) {
            $_SESSION['flash_notifications'] = [];
        }

        $_SESSION['flash_notifications'][] = [
            'body' => $message,
            'type' => $type
        ];
    }

    /**
     * Get all the messages
     */
    public static function getMessages()
    {
        if(isset($_SESSION['flash_notifications'])) {
            $messages = $_SESSION['flash_notifications'];
            unset($_SESSION['flash_notifications']);

            return $messages;
        }
    }
 }