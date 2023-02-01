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
    $teste =  [
         array('mamadi',4,2,3,5,5.67,6.56,6),
         array('mamadi',4,2,3,5,5.67,6.56,6),
         array('masingacite',4,2,3,5,5.67,6.56,6),
         array('masingacite',4,2,3,5,5.67,6.56,6),
         array('eva',4,2,3,5,5.67,6.56,6),
         array('eva',4,2,3,5,5.67,6.56,6),
         array('saran',4,2,3,5,5.67,6.56,6),
         array('saran',4,2,3,5,5.67,6.56,6),
         array('fanta',4,2,3,5,5.67,6.56,6),
         array('fanta',4,2,3,5,5.67,6.56,6),

    ];
    $newArray = array();
    $sum1 = 0;
    $sum2 = 0;
    $sum3 = 0;
    $sum4 = 0;
    $sum5 = 0;
    $sum6 = 0;
    $sum7 = 0;
    function sumValues($item) {
        $carry = 0;
        $carry += $item;
        return $carry;
    }


    function array_keys_exist( $array, $index, $id, $row)
    {

        if (isset( $array[$id][$index] ))
        {
             return $array[$id][$index] += $row;
        }

        return  $array[$id][$index] = $row;
    }

        $sum = array();
        $newArraye = array();
        foreach($teste as $key => $values) {

            $name = $values[0];
            $sum[$name]['nom'] = array_keys_exist( $sum, 'nom', $name, $values[1]);
            $sum[$name]['prenom'] = array_keys_exist( $sum, 'prenom', $name, $values[2]);
            $sum[$name]['int1'] = array_keys_exist( $sum, 'int1', $name, $values[3]);
            $sum[$name]['int2'] = array_keys_exist( $sum, 'int2', $name, $values[4]);
            $sum[$name]['int3'] = array_keys_exist( $sum, 'int3', $name, $values[5]);
            $sum[$name]['int4'] = array_keys_exist( $sum, 'int4', $name, $values[6]);
            $sum[$name]['int5'] = array_keys_exist( $sum, 'int5', $name, $values[7]);
            $newArraye = $sum;
        }

         error_log(' refactoren Code = > '.print_r( $newArraye,true ) );







}