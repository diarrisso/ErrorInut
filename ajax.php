<?php

require_once 'config.php';


$connection = getConnection();

if ($connection) {
    echo 'bingo';

} else {

    echo 'error du server';
    error_log(' error du server ');
}


if( $_FILES['upload']['error'] == 0 ) {
    $name = $_FILES['upload']['name'];
    $array = explode('.', $_FILES['upload']['name']);
    $type = $_FILES['upload']['type'];
    $tmpName = $_FILES['upload']['tmp_name'];
    $tmpSize = $_FILES['upload']['size'];

    $csv_data = array_map('str_getcsv', file($tmpName));
    $result = null;


    $sum = array();
    $newArraye = array();
    foreach ($csv_data as $key => $values) {

        /*if ($values[12])  {
            continue;
            $filter = str_replace('.', ',', $values[12]);
            $zerofilter = str_replace('00', '0', $values[5]);
            error_log(' point figuire => '.print_r( $filter,true ) );

            error_log(' zero = > '.print_r( $zerofilter,true ) );
        }*/
        error_log(' neauveau tableau = > ' . print_r($values, true));

        $newArraye = $values;
    }
    error_log(' neauveau tableau = > ' . print_r($newArraye, true));
}


/**
 * @return bool
 */
function isValidDaxAndTime(): bool
{
    $day = (int)date('N');
    $time = (int)date('Gi');
    $timeFrom = 2100;
    $timeTo = 2130;
    error_log('day today  => ' . print_r($day, true));
    error_log('time => ' . print_r($time, true));
    error_log('timeFrom => ' . print_r($timeFrom, true));
    error_log('timeTO  => ' . print_r($timeTo, true));

    $rageer = $day === 2 || $day === 4;
    $time = $time >= $timeFrom && $time <= $timeTo;

    var_dump($rageer);
    var_dump($time);

    if ($rageer !== true) {
        echo 'email kann versad' . PHP_EOL;
        return false;
    }

    if ($time !== true )
    {
        return false;
    }

    return true;
}

$day = (int)date('N');

if (isValidDaxAndTime() !== false) {
    echo 'bin go';
    error_log('dddddd' . print_r($day, true));
}



















