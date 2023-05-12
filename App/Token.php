<?php

namespace App;

use \App\Config;

/**
 * Unique random tokens
 * 
 * PHP version 8.1.10
 */

 class Token
 {
    protected $token;

    /**
     * Classs constructor. Create a new random token.
     */
    public function __construct($token_value = null)
    {
        if ($token_value) {
            $this->token = $token_value;
        } else {
            $this->token = bin2hex(random_bytes(16));
        }
    }

    /**
     * Get the token value
     */
    public function getValue()
    {
        return $this->token;
    }

    /**
     * Get the hashed token value
     */
    public function getHash()
    {
        return hash_hmac('sha256', $this->token, \App\Config::SECRET_KEY);
    }
}