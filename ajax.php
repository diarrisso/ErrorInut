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
         array('mamadi',1,2,3,0.00,5.67,6.56,7.56),
        array('mamadi',1,2,3,4,5,6,7.600),
        array('mamadi',1,2,3,4,5,6,7),
        array('mamadi',1,2,3,4,5,6,7),
        array('mamadi',1,2,3,4,5,6,7),
        array('eva',150,25,35,45,55,65,75),
        array('eva',15,25,35,45,56,66,79),
        array('eva',14,25,36,47,57,67,77),
        array('eva',14,25,36,47,57,67,77),
        array('eva',14,25,36,47,57,67,77),
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


    $sum = array_fill_keys(array_keys(reset($teste)), 0);

    foreach($sum as $key => &$value) {
        $value = array_sum(array_column($teste, $key));
    }



    $sum = [];

    foreach($teste as $item) {
        foreach($item as $key => $values) {
            if (!isset($sum[$key])) $sum[$key] = 0;
            $sum[$key] += $values;
            $name = $values[0];
            $sum[$key]['nom'] += $values[1];
            $sum[$key]['prenom'] += $values[2];
            $sum[$key]['int1'] += $values[3];
            $sum[$key]['int2'] += $values[4];
            $sum[$key]['int3'] += $values[5];
            $sum[$key]['int4']+= $values[6];
            $sum[$key]['int5'] += $values[7];
            $newArray[] = $sum;
        }
    }




    error_log('$message'.print_r($newArray,true));
    print_r($sum);
    die();



    foreach ( $teste as $key => $item ) {

        /*$data[$name]['nom'] = sumValues($item[1]);
        $data[$name]['prenom'] = sumValues($item[2]);
        $data[$name]['int1'] =sumValues($item[3]);
        $data[$name]['int2'] = sumValues($item[4]);
        $data[$name]['int3'] = sumValues($item[5]);
        $data[$name]['int4']=  sumValues($item[6]);
        $data[$name]['int5'] = sumValues($item[7]);
        $newArray = $data;*/
}





    error_log('$data first => '.print_r( $newArray, true ) );
    die();

    $CSVData = array();
    $output = array();
    foreach ( $csv_data as $key => $row ) {

        $column = $row[3];

        $output[$row[3]]['benitzer'] = $row[6];
        $output[$row[3]]['nom'] = $row[5];
        $output[$row[3]]['studie'] = $row[8];
        $output[$row[3]]['email'] = $row[3];
        $output[$row[3]]['email'] = $row[4];
        $output[$row[3]]['queue'] = $row[9];
        $output[$row[3]]['date'] = $row[7];
        $CSVData[$column] = $output;
    }

    error_log(' array  csvdata => '.print_r($CSVData, true));
}

function array_group( array $data, $by_column )
{
    $result = [];
    foreach ($data as $item) {
        $column = $item[$by_column];
        unset($item[$by_column]);
        $result[$column][] = $item;
    }
    return $result;
}