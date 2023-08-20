<?php
// Include the necessary files and configurations
session_start();
include '../config/config.php';
//require_once '../links.php';

// Function to sanitize input data
function sanitizeInput($input) {
    return filter_var($input, FILTER_SANITIZE_STRING);
}

// Set up the response array
$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Receiving payload data from the client
    $receivedData = json_decode(file_get_contents('php://input'), true);

    // Check if payload data is valid
    $username = isset($receivedData['username']) ? sanitizeInput($receivedData['username']) : "";
    $password = isset($receivedData['password']) ? $receivedData['password'] : "";

    if (empty($username) || empty($password)) {
        $response['error'] = "Invalid input.";
        http_response_code(400); // Bad Request
    } else {
        // Perform login authentication
        $query = "SELECT * FROM tbltrainers WHERE (email = ? OR phoneNumber = ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'ss', $username, $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        
        if ($row) {
            // User found based on email/phone number
            $hashedPassword = $row['password'];
            if (password_verify($password, $hashedPassword)) {
                // Password matches, log the user in
                $_SESSION['email'] = $row['email'];
                $response['success'] = "Login success";
                http_response_code(200); // OK
            } else {
                $response['error'] = "Invalid username or password.";
                http_response_code(401); // Unauthorized
            }
        } else {
            $response['error'] = "Invalid username or password.";
            http_response_code(401); // Unauthorized
        }
    }
} else {
    $response['error'] = "Invalid request method.";
    http_response_code(405); // Method Not Allowed
}

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
