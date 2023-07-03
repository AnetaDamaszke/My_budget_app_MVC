<?php

namespace App;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use App\Config;

/**
 * Mail
 * 
 * PHP version 8.1.10
 */

 class Mail 
 {
    /**
     * Send a message
     */
    public static function send($to, $subject, $text, $html)
    {
        $mail = new PHPMailer();
        
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = CONFIG::PHPMAILER_USER;            //SMTP username
        $mail->Password   = CONFIG::PHPMAILER_PASSWORD;                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;    
        $mail->CharSet = 'UTF-8';

        $mail->setFrom('from@example.com', 'MyBydgetApp');
        $mail->addAddress($to);
        $mail->addReplyTo('biuro@example.com', 'Odp');

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $text;
        $mail->AltBody = $html; 

        $mail->send();
    }
 }