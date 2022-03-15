<?php
require_once dirname(__FILE__) . '/../config.php';
include _ROOT_PATH . '/app/security/check.php';
function getParameters(&$amount, &$years, &$interest)
{
    $amount = isset($_REQUEST['amount']) ? $_REQUEST['amount'] : null;
    $years = isset($_REQUEST['years']) ? $_REQUEST['years'] : null;
    $interest = isset($_REQUEST['interest']) ? $_REQUEST['interest'] : null;
}

function validate(&$amount, &$years, &$interest, &$messages)
{
    if (!(isset($amount) && isset($years) && isset($interest))) {
        return false;
    }
    if ($amount == "") {
        $messages [] = 'Nie podano kwoty';
    }
    if ($years == "") {
        $messages [] = 'Nie podano liczby lat';
    }
    if ($interest == "") {
        $messages [] = 'Nie podano oprocentowania';
    }
    if (!empty($messages)) {
        return false;
    }

    if (!is_numeric($amount) && $amount>0) {
        $messages [] = 'Kwota nie jest dodatnią liczbą całkowitą';
    }
    if (!is_numeric($years) && $years>0) {
        $messages [] = 'Czas kredytu nie jest dodatnią liczbą całkowitą';
    }
    if (!(is_numeric($interest) && $interest>0)) {
        $messages [] = 'Oprocentowanie nie jest dodatnią liczbą całkowitą';
    }

    return empty($messages);
}

function process(&$amount, &$years, &$interest,&$messages, &$result)
{
    global $role;
    $amount = intval($amount);
    $years = intval($years);
    $interest = intval($interest);

    //zmienne pomocnicze
    $numberOfMonths = $years * 12;
    $amountWithInterest = $amount + $amount * ($interest / 100);


    $unroundedResult = $amountWithInterest / $numberOfMonths;

    if($years > 2){
        if($role== 'admin'){
            $result = round($unroundedResult, 2);
        }
        else{
            $messages [] ='Tylko administrator może wziąć kredyt na więcej niż 2 lata';
        }
    }
    else{
        $result = round($unroundedResult, 2);
    }



}

$amount = null;
$years = null;
$interest = null;
$result = null;
$messages = array();

getParameters($amount, $years, $interest);
if (validate($amount, $years, $interest, $messages)) {
    process($amount, $years, $interest, $messages, $result);
}

include 'calc_view.php';



