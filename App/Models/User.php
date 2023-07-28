<?php

namespace App\Models;

use PDO;
use \App\Token;
use \App\Mail;
use \Core\View;

/**
 * User model
 * 
 * PHP version 8.1.10
 */

 class User extends \Core\Model
 {
    /**
     * Error message
     */
    public $errors = [];

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
        $this->validate();

        if(empty($this->errors)) {
          
            $password_hash = password_hash($this->password, PASSWORD_DEFAULT);

            $token= new Token();
            $hashed_token = $token->getHash();
            $this->activation_token = $token->getValue();

            $sql = 'INSERT INTO users (name, email, password_hash, activation_hash)
                    VALUES (:name, :email, :password_hash, :activation_hash)';

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
            $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);
            $stmt->bindValue(':activation_hash', $hashed_token, PDO::PARAM_STR);

            $stmt->execute();

            $this->addDefaultIncomesCategoriesToUser();
            $this->addDefaultExpensesCategoriesToUser();
            $this->addDefaultPaymentMethodsToUser();

            return true;
        }

        return false;
    }

    /**
     * Validate current property values
     */
    public function validate()
    {
          // Name
          if ($this->name == '') {
            $this->errors[] = 'Imię jest wymagane';
          }
    
          // Email
          if (filter_var($this->email, FILTER_VALIDATE_EMAIL) === false) {
            $this->errors[] = 'Niepoprawny email';
          }

          if(static::emailExists($this->email, $this->id ?? null)) {
            $this->errors[] = 'Ten email juz istnieje!';
          }
    
          // Password
          if (isset($this->password)) {
            if (strlen($this->password) < 6) {
              $this->errors[] = 'Proszę podaj conajmniej 6 znaków';
            }
      
            if (preg_match('/.*[a-z]+.*/i', $this->password) == 0) {
              $this->errors[] = 'Hasło musi posiadać conajmniej 1 literę i 1 cyfrę';
            }
      
            if (preg_match('/.*\d+.*/i', $this->password) == 0) {
              $this->errors[] = 'Hasło musi posiadać conajmniej 1 cyfrę';
            }
          }
    }

    /**
     * See if a user aleady exist with the specified email
     */
    public static function emailExists($email, $ignore_id = null) 
    {
        $user = static::findByEmail($email);

        if ($user) {
          if ($user->id != $ignore_id) {

            return true;

          }
        }

        return false;
    }

    /**
     * Find a user model by email address
     */
    public static function findByEmail($email) 
    {
      $sql = 'SELECT * FROM users WHERE email = :email';

      $db = static::getDB();
      $stmt = $db->prepare($sql);
      $stmt->bindValue(':email', $email, PDO::PARAM_STR);

      $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

      $stmt->execute();

      return $stmt->fetch();
    }

    /**
     * Authenticate a user by email and password
     */
    public static function authenticate($email, $password)
    {
      $user = User::findByEmail($email);

      if($user && $user->is_active) {
        if(password_verify($password, $user->password_hash)) {
          return $user;
        }
      }
      return false;
    }

    /**
     * Find a user model by ID
     */
    public static function findByID($id) 
    {
      $sql = 'SELECT * FROM users WHERE id = :id';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * Remember the login by inserting a new unique token into the rememered_logins table
     */
    public function rememberLogin()
    {
      $token = new Token();
      $hashed_token = $token->getHash();

      $this->remember_token = $token->getValue();

      $this->expiry_timestamp = time() + 60 * 60 * 24 * 30; // 30 day from now

      $sql = 'INSERT INTO remembered_logins (token_hash, user_id, expires_at)
      VALUES (:token_hash, :user_id, :expires_at)';

      $db = static::getDB();
      $stmt = $db->prepare($sql);

      $stmt->bindValue(':token_hash', $hashed_token, PDO::PARAM_STR);
      $stmt->bindValue(':user_id', $this->id, PDO::PARAM_INT);
      $stmt->bindValue(':expires_at', date('Y-m-d H:i:s', $this->expiry_timestamp), PDO::PARAM_STR);

      return $stmt->execute();
    }

    /**
     * Send password reset instuctions to the user specified
     */
    public static function sendPasswordReset($email)
    {
      $user = static::findByEmail($email);

      if($user) {
        
        if($user->startPasswordReset()) {

          $user->sendPasswordResetEmail();

        }

      }
    }

    /**
     * Start the password reset process by generating a new token
     */
    protected function startPasswordReset()
    {
      $token = new Token();
      $hashed_token = $token->getHash();
      $this->password_reset_token = $token->getValue();

      $expiry_timestamp = time() + 60 * 60 * 2; 

      $sql = 'UPDATE users 
              SET password_reset_hash = :token_hash, 
                  password_reset_expires_at = :expires_at
              WHERE id = :id';

      $db = static::getDB();
      $stmt = $db->prepare($sql);

      $stmt->bindValue(':token_hash', $hashed_token, PDO::PARAM_STR);
      $stmt->bindValue(':expires_at', date('Y-m-d H:i:s', $expiry_timestamp), PDO::PARAM_STR);
      $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

      return $stmt->execute();
    }

    /**
     * Send password reset instructins in an aemail to the user
     */
    protected function sendPasswordResetEmail()
    {
      $url = 'http://' . $_SERVER['HTTP_HOST'] . '/password/reset/' . $this->password_reset_token;

      $text = View::getTemplate('Password/reset_email.txt', ['url' => $url]);
      $html = View::getTemplate('Password/reset_email.html', ['url' => $url]);

      Mail::send($this->email, 'Resetowanie hasła', $text, $html);
    }

    /**
     * Find a user by password reset token and expiry
     */
    public static function findByPasswordReset($token)
    {
      $token = new Token($token);
      $hashed_token = $token->getHash();

      $sql = 'SELECT * FROM users 
              WHERE password_reset_hash = :token_hash';

      $db = static::getDB();
      $stmt = $db->prepare($sql);

      $stmt->bindValue(':token_hash', $hashed_token, PDO::PARAM_STR);

      $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

      $stmt->execute();

      $user = $stmt->fetch();

      if ($user) {

        // Check password reset token hasn't expired
        if (strtotime($user->password_reset_expires_at) > time()) {

          return $user;
          
        }

      }
    }

    /**
     * Reset the password
     */
    public function resetPassword($password) 
    {
      $this->password = $password;

      $this->validate();

      if (empty($this->errors)) {

        $password_hash = password_hash($this->password, PASSWORD_DEFAULT);

        $sql = 'UPDATE users 
              SET password_hash = :password_hash,
                  password_reset_hash = NULL, 
                  password_reset_expires_at = NULL
              WHERE id = :id';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);

        return $stmt->execute();
      }

      return false;
    }

    /**
     * Send an email to the user containig the activation link
     */
    public function sendActivationEmail()
    {
      $url = 'http://' . $_SERVER['HTTP_HOST'] . '/signup/activate/' . $this->activation_token;

      $text = View::getTemplate('Signup/activation_email.txt', ['url' => $url]);
      $html = View::getTemplate('Signup/activation_email.html', ['url' => $url]);

      Mail::send($this->email, 'Aktywacja konta', $text, $html);
    }

    /**
     * Ativate the user account with the specified activation tken
     */
    public static function activate($value)
    {
      $token = new Token($value);
      $hashed_token = $token->getHash();

      $sql = 'UPDATE users
              SET is_active = 1,
              activation_hash = null
              WHERE activation_hash = :hashed_token';

      $db = static::getDB();
      $stmt = $db->prepare($sql);

      $stmt->bindValue(':hashed_token', $hashed_token, PDO::PARAM_STR);

      $stmt->execute();
    }

    /**
     * Copying default incomes categories to user categories
     */
    public function addDefaultIncomesCategoriesToUser()
    {
      $sql = 'INSERT INTO incomes_category_assigned_to_users (user_id, category_name) 
      SELECT users.id, incomes_category_default.name 
      FROM users, incomes_category_default 
      WHERE users.name = :username';
      
      $db = static::getDB();
      $stmt = $db->prepare($sql);

      $stmt -> bindValue(':username', $this->name, PDO::PARAM_STR);
      
      return $stmt -> execute();
    }

    /**
     * Copying default expenses categories to user categories
     */
    public function addDefaultExpensesCategoriesToUser()
    {
      $sql = 'INSERT INTO expenses_category_assigned_to_users (user_id, category_name) 
      SELECT users.id, expenses_category_default.name 
      FROM users, expenses_category_default 
      WHERE users.name = :username';
      
      $db = static::getDB();
      $stmt = $db->prepare($sql);

      $stmt -> bindValue(':username', $this->name, PDO::PARAM_STR);
      
      return $stmt -> execute();
    }

    /**
     * Copying default payment methods to user
     */
    public function addDefaultPaymentMethodsToUser()
    {
      $sql = 'INSERT INTO payment_methods_assigned_to_users (user_id, name) 
      SELECT users.id, payment_methods_default.name 
      FROM users, payment_methods_default 
      WHERE users.name = :username';
      
      $db = static::getDB();
      $stmt = $db->prepare($sql);

      $stmt -> bindValue(':username', $this->name, PDO::PARAM_STR);
      
      return $stmt -> execute();
    }
}
