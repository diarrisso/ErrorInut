<?php
function getConnection()
{

    $conn = null;
    $servername = 'localhost:3306';
    $username = 'root';
    $password = 'root';

    try {
        $conn = new PDO("mysql:host=$servername;dbname=Blog", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
    return $conn;

}
