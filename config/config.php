<?php
//$localhost ='20.50.195.68';
//$localhost ='localhost';

$host = "localhost";
$socket = '3306';
$user = 'root';
$hostpassword = '';
$database = 'FitKonnect';

// Create connection
$conn = new mysqli($host, $user, $hostpassword, $database, $socket);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

//echo 'Connected successfully';

// Close the connection
//$conn->close();
?>
