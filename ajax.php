<?php

if( $_FILES['upload']['error'] == 0 ) {
    $name = $_FILES['upload']['name'];
    $array = explode('.', $_FILES['upload']['name']);
    $type = $_FILES['upload']['type'];
    $tmpName = $_FILES['upload']['tmp_name'];
    $tmpSize = $_FILES['upload']['size'];

    $csv_data = array_map('str_getcsv', file($tmpName));

    /*array_walk($csv_data , function(&$x) use ($csv_data) {
        $x = array_combine($csv_data[0], $x);
    });*/

    /**
     *
     * array_shift = remove first value of array
     * in csv file header was the first value
     *
     */
    array_shift($csv_data);

// Print Result Data


   $CSVData = array();
    $output = array();
    foreach ($csv_data as $key => $row ) {
        if ( empty( $row ))  {
            continue;
        }

        if ($key === 0 ) {
            continue;
        }


        if ( array_key_exists($row[0], $output) ) {

            // this is duplicate based on date - merge into output
            $output[$row[0]] = array_merge($output[$row[0]], $row);
        } else {

            // new entry for date
            $output[$row[0]] = $row;
        }




        $first_names = array_column($csv_data, 'id');
        $CSVData = $row;

    }

    $result = [];
    foreach ($csv_data as $item) {
        $column = $item[0];
        unset($item[0]);
        $result[$column][] =  implode(',', $item);
    }


    print_r($result);



}


function array_group(array $data, $by_column)
{
    $result = [];
    foreach ($data as $item) {
        $column = $item[$by_column];
        unset($item[$by_column]);
        $result[$column][] = $item;
    }
    return $result;
}