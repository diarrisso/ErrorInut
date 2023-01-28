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

    /**
     *
     * array_shift = remove first value of array
     * in csv file header was the first value
     *
     */
    //array_shift($csv_data);

    $CSVData = array();
    $output = array();
    foreach ( $csv_data as $key => $row ) {
        $separator = ':';
        $fragen = explode( $separator, $row[1]) ;
        $nom = explode(" ", $row[3]);
        $prenom = $nom[0];
        $nachnme = $nom[1];
        $fragen = trim( $fragen[0]);
        $column = $row[0];
        unset($row[0]);
        $csvDatum = "2023-01-11";

        if ($row[7] != $csvDatum ) {
            continue;
        }

        error_log('datum =>'.print_r( $row[7] ) );
        /*$date = date_create($row[7]);
        $newDatas = date_format($date, 'Y-m-d');*/
        $output['benitzer'] = $row[6];
        $output['nom'] = $row[5];
        $output['studie'] = $row[8];
        $output['email'] = $row[3];
        $output['email'] = $row[4];
        $output['queue'] = $row[9];
        $output['date'] = $row[7];
        $output[$column]['fragenAntworte'][$fragen] = $row[2];
        $CSVData[$column] = $output;

    }
    error_log(' array => '.print_r($CSVData, true));

    /*if ( strpos($row[8], 'Wholebuy') ) {
        error_log('business = > business WB');
        echo 'business WB';
    } else {
        error_log('business ');
        echo 'business ';
    }



    if (! strpos($row[8], 'Wholebuy') ) {
        error_log('business TKS');
        echo 'business WB';
    }


    if ( strpos($row[1], "210", 1) ) {
        error_log('offset');
        echo 'offset';
    }


    $start = $row[1];

    if ( $start[0] === "2" && $start[1] === "1" && $start[2] === "0" ){
        error_log("coole");

    }

    if ($start[0] === '4' && $start[1] === '1' && $start[2] === '0') {
        error_log('coole');
        exit();
    }


if (strlen($row[1]) === "210") {
error_log("salut ");
}


    $nummer  = explode(':', $row[1]);

          $c = '5';

    if ($row[0]) {
        $interwiewIde = $row[0];
    }

    if ($row[5]) {
        $vormane = $row[5];
    }

    if ($row[6]) {
        $nachname = $row[6];
    }*/




    /*switch ($nummer) {

        case "2100000002000400":


            break;
        case '2100000002001800':
            echo 'ja';
            break;
        default :
            'cool';
    }*/


    //error_log('le premier foreach => '  .print_r( $CSVData, true ) );





    /*  $data = array();
    foreach ( $CSVData  as  $interviewId => $value ) {

        $data['interviewId'] = $interviewId ;
        $data = $value;


    }*/



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