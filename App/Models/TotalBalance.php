<?php

namespace App\Models;

use PDO;
use \App\Auth;

/**
 * Balance model
 * 
 * PHP version 8.1.10
 */

 class TotalBalance extends \Core\Model
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

    public static function chooseDates()
    {   
        $date1 = '';
        $date2 = '';
        $title = '';

        if(isset($_POST['dates']) && ($_POST['dates'] == '1')) {

            $day = date('t');

            $date1 = date('Y-m-01');
            $date2 = date('Y-m-'.$day);

            $title = 'Twój bilans w bieżącym miesiącu';  

        } else if(isset($_POST['dates']) && ($_POST['dates'] == '2')) {
            
            $day = date('t', mktime(0,0,0, date('m')-1, 1, date('Y')));
            $month = date('m')-1;

            $date1 = date('Y-'.$month.'-01');
            $date2 = date('Y-'.$month.'-'.$day);

            $title = 'Twój bilans w poprzednim miesiącu';  

        } else if(isset($_POST['dates']) && ($_POST['dates'] == '3')) {

            $date1 = date('Y-01-01');
            $date2 = date('Y-m-d');

            $title = 'Twój bilans w bieżącym roku';

        } else if(isset($_POST['dates']) && ($_POST['dates'] == '4')) {
            
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];

            $title = 'Twój bilans w okresie od '.$date1.' do '.$date2.':';

        } else {
            $_SESSION['message'] = 'Zaznacz zakres dat!';
        }

        return $title;
    } 
 }