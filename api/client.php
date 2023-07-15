<?php
// include necessary files and configurations
include '../config/config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check the HTTP method
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        // Include the script for handling POST request
        include 'createClient.php';
        break;
    case 'GET':
        // Include the script for handling GET request
        include 'getClient.php';
        break;
    case 'DELETE':
        // Include the script for handling DELETE request
        include 'deleteClient.php';
        break;
    case 'PUT':
        // Include the script for handling PUT request
        include 'updateClient.php';
        break;
    default:
        // Invalid or unsupported HTTP method
        http_response_code(405);
        break;
}
?>
