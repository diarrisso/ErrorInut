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
    foreach ( $csv_data as $key => $row ) {
        unset($row[12]);
        unset($row[11]);
        unset($row[14]);
        unset($row[13]);

            $nummer  = explode(':', $row[1]);

        $c = '5';

            switch ($nummer[0]) {
                case "2100000002002300":
                    $insertQuery = "INSERT INTO Blog.tbl_users( 
                           tbl_users.userName,
                           tbl_users.firstName, 
                           tbl_users.bwertung,
                           tbl_users.interviewID,
                           tbl_users.bussines,
                            tbl_users.nps,
                           tbl_users.queu,
                           tbl_users.bemerkung
                           )VALUES ('" . $row[5] . "', '" . $row[6] . "', '" . $c[0] . "', '" . $row[0] . "', '" . $row[8] . "', '" . $row[4] . "','" . $row[3] . "',  '" . $row[9] . "')";
                    $statement = $connection->prepare($insertQuery);
                    $statement->execute();
                    break;
                case "21900000002000500":
                    $insertQuery = "INSERT INTO Blog.tbl_users( 
                           tbl_users.userName,
                           tbl_users.firstName, 
                           tbl_users.bwertung,
                           tbl_users.interviewID,
                           tbl_users.bussines,
                            tbl_users.nps,
                           tbl_users.queu,
                           tbl_users.bemerkung
                           )VALUES ('" . $row[5] . "', '" . $row[6] . "', '" . $c[0] . "', '" . $row[0] . "', '" . $row[8] . "', '" . $row[4] . "','" . $row[3] . "',  '" . $row[9] . "')";
                    $statement = $connection->prepare($insertQuery);
                    $statement->execute();
                    break;
                default :
                    'salut ';
            }


       if ($nummer[0] == "2100000002002300" ) {


            $c =  "5";
            $insertQuery = "INSERT INTO Blog.tbl_users( 
                           tbl_users.userName,
                           tbl_users.firstName, 
                           tbl_users.bwertung,
                           tbl_users.interviewID,
                           tbl_users.bussines,
                            tbl_users.nps,
                           tbl_users.queu,
                           tbl_users.bemerkung
                           )VALUES ('".$row[5]."', '".$row[6]."', '".$c[0]."', '".$row[0]."', '".$row[8]."', '".$row[4]."','".$row[3]."',  '".$row[9]."')";
            $statement = $connection->prepare($insertQuery);
            $statement->execute();

        }


        if ($nummer[0] == "21900000002000500") {


            $c = '5';
            echo $c;
            $insertQuery = "INSERT INTO Blog.tbl_users( 
                           tbl_users.userName,
                           tbl_users.firstName, 
                           tbl_users.bwertung,
                           tbl_users.interviewID,
                           tbl_users.bussines,
                            tbl_users.nps,
                           tbl_users.queu,
                           tbl_users.bemerkung
                           )VALUES ('" . $row[5] . "', '" . $row[6] . "', '" . $c. "', '" . $row[0] . "', '" . $row[8] . "', '" . $row[4] . "','" . $row[3] . "',  '" . $row[9] . "')";
            $statement = $connection->prepare($insertQuery);
            $statement->execute();

        }


        if ($nummer[0] == "2100000002001300") {


            $c = '5';
            $insertQuery = "INSERT INTO Blog.tbl_users( 
                           tbl_users.userName,
                           tbl_users.firstName, 
                           tbl_users.bwertung,
                           tbl_users.interviewID,
                           tbl_users.bussines,
                            tbl_users.nps,
                           tbl_users.queu,
                           tbl_users.bemerkung
                           )VALUES ('" . $row[5] . "', '" . $row[6] . "', '" . $c. "', '" . $row[0] . "', '" . $row[8] . "', '" . $row[4] . "','" . $row[3] . "',  '" . $row[9] . "')";
            $statement = $connection->prepare($insertQuery);
            $statement->execute();

        }


        if ($nummer[0] == '21900000002000500') {


            $c = '5';
            echo $c;
            $insertQuery = "INSERT INTO Blog.tbl_users( 
                           tbl_users.userName,
                           tbl_users.firstName, 
                           tbl_users.bwertung,
                           tbl_users.interviewID,
                           tbl_users.bussines,
                            tbl_users.nps,
                           tbl_users.queu,
                           tbl_users.bemerkung
                           )VALUES ('" . $row[5] . "', '" . $row[6] . "', '" . $c . "', '" . $row[0] . "', '" . $row[8] . "', '" . $row[4] . "','" . $row[3] . "',  '" . $row[9] . "')";
            $statement = $connection->prepare($insertQuery);
            $statement->execute();
             exit();
        }


        if ($row[0]) {
            $interwiewIde = $row[0];
        }

        if ($row[5]) {
            $vormane = $row[5];
        }

        if ($row[6]) {
            $nachname = $row[6];
        }




        /*switch ($nummer) {

            case "2100000002000400":


                break;
            case '2100000002001800':
                echo 'ja';
                break;
            default :
                'cool';
        }*/
        $CSVData = $row;

    }

    error_log('row => '  . print_r( $CSVData, true ) );


    json_encode($csv_data);

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