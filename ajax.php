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


    $result = null;
    $teste =  array( array( '12345566666',
                     'diarrisso',
                     'saran',
                     4,
                     4,
                     4,
                     4
                 ),
             );
    $newArray = array();
    $data = array();
    foreach ( $teste as $key => $item ) {

        error_log('items dans foreach  => ' . print_r($item, true));

        $data['id'] = $item[0];
        $data['nom'] = $item[1];
        $data['prenom'] = $item[2];
        $data['int1'] = $item[3];
        $data['int2'] = $item[4];
        $data['int3'] = $item[5];
        $data['int4'] = $item[6];
        $newArray = $data;
        $output = array_slice( $newArray, 1);
        $result = array_sum($output);
}
        $newArray['sum'] = $result;
    error_log('$rsulte de =>'.print_r( $result, true ) );
    error_log('$data =>'.print_r( $newArray, true ) );
    error_log('$output =>'.print_r( $output, true ) );

    die();
    //array_shift($csv_data);

    $CSVData = array();
    $output = array();
    foreach ( $csv_data as $key => $row ) {
        $separator = ':';
        $fragen = explode( $separator, $row[1]) ;
        /*$nom = explode(" ", $row[4]);
        $prenom = $nom[0];
        $nachnme = $nom[1];*/
        $fragen = trim( $fragen[0]);
        $column = $row[0];
        unset($row[0]);
        $csvDatum = "2023-01-11";

        /*if ($row[7] != $csvDatum ) {
            continue;
        }*/

        if (!in_array($csvDatum, $row) ) {
            continue;
            //error_log('oui il \'est pas dedant ');

        }

        if ($key === 1) {

            continue;

        }

        $result = array_sum($row);

        error_log('datum =>'.print_r( $row[7] ) );
        error_log('resulte =>'.$result);
        $date = date_create($row[7]);
        $newDatas = date_format($date, 'Y-m-d');
        $output[$row[7]]['benitzer'] = $row[6];
        $output[$row[7]]['nom'] = $row[5];
        $output[$row[7]]['studie'] = $row[8];
        $output[$row[7]]['email'] = $row[3];
        $output[$row[7]]['email'] = $row[4];
        $output[$row[7]]['queue'] = $row[9];
        $output[$row[7]]['date'] = $row[7];
        $output[$row[7]][$column]['fragenAntworte'][$fragen] = $row[2];
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