<?php

if( $_FILES['upload']['error'] == 0 ) {
    $name = $_FILES['upload']['name'];
    $array = explode('.', $_FILES['upload']['name']);
    $type = $_FILES['upload']['type'];
    $tmpName = $_FILES['upload']['tmp_name'];
    $tmpSize = $_FILES['upload']['size'];

    $csv_data = array_map('str_getcsv', file($tmpName));

    array_walk($csv_data , function(&$x) use ($csv_data) {
        $x = array_combine($csv_data[0], $x);
    });

    /**
     *
     * array_shift = remove first value of array
     * in csv file header was the first value
     *
     */
    array_shift($csv_data);

// Print Result Data
    echo '<pre/>';
    print_r($csv_data);




}