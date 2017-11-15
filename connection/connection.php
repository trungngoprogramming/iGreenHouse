<?php

$server_username = "root";
$server_password = "root";
$server_host = "localhost";
$database = 'igreenhousedb';

$conn = mysqli_connect($server_host,$server_username,$server_password,$database) or die("cannot connection to database");
mysqli_query($conn, "SET NAMES 'UTF8'");

// define('CONNECTION', $conn);

?>