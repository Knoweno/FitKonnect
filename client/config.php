<?php
$host = 'localhost';
$socket = '3306';
$user = 'root';
$password = '';
$database = 'FitKonnect';

// Create connection
$conn = new mysqli($host, $user, $password, $database, $socket);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

//echo 'Connected successfully';

// Close the connection
//$conn->close();
?>
