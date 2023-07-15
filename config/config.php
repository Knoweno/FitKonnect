<?php
$host = 'localhost';
$socket = '3307';
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
