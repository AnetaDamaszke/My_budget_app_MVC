<?php

namespace Core;

use \App\Flash;

/**
 * View
 * 
 * PHP version 8.1.10
 */

 class View
 {
    /**
     * Render a view file
     */
    public static function render($view, $args = [])
    {   
        extract($args, EXTR_SKIP);

        $file = "../App/Views/$view"; // relative to Core directory

        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file not found");
        }
    }

    /**
     * Render a view template using Twig
     */
    public static function renderTemplate($template, $args = [])
    {
        echo static::getTemplate($template, $args);
    }

    /**
     * Get the content of a view template using Twig
     */
    public static function getTemplate($template, $args = [])
    {
        static $twig = null;

        if ($twig === null) {
            $loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__) . '/App/Views');
            $twig = new \Twig\Environment($loader);
            $twig->addGlobal('current_user', \App\Auth::getUser());
            $twig->addGlobal('flash_messages', \App\Flash::getMessages());
            $twig->addGlobal('income_category', \App\Models\Income::getIncomeCategoryAssignedToUser());
            $twig->addGlobal('expense_category', \App\Models\Expense::getExpenseCategoryAssignedToUserName());
            $twig->addGlobal('payment_method', \App\Models\Expense::getPaymentMethodsAssignedToUserName());
            $twig->addGlobal('incomes', \App\Models\TotalBalance::getIncome());
        }

        return $twig->render($template, $args);
    }
 }