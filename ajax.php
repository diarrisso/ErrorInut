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
        foreach( $csv_data as $key => $values) {

          $chiffre = $values[12];

            error_log(' replace quoi => '.print_r( $values[12],true ) );

            error_log(' zero => '.print_r( $values[5],true ) );

            $chiffre = str_replace('.', ',', $values[12]);
            $zero = str_replace('00', ',0', $values[5]);
         $sum['nouveau'] = $values;


            error_log(' point figuire => '.print_r( $chiffre,true ) );

            error_log(' zero = > '.print_r( $zero,true ) );



        }
        error_log(' neauveau tableau = > '.print_r( $sum,true ) );
}