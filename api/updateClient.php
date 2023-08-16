<?php

// Include your database configuration here
// $host = "your_host";
// $user = "your_username";
// $password = "your_password";
// $database = "your_database";
// $socket = "your_socket";

// $host = "localhost";
// $socket = '3306';
// $user = 'root';
// $hostpassword = '';
// $database = 'FitKonnect';

// // Create a new MySQLi object
// $conn = new mysqli($host, $user, $password, $database, $socket);

// Check the connection
// if ($conn->connect_error) {
//     // Handle the database connection error
//     http_response_code(500);
//     echo json_encode(['error' => 'Database connection failed']);
//     exit;
// }

// Check if the request method is PUT
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {

    $conn = new mysqli($host, $user, $hostpassword, $database, $socket);

    // Check the connection
    if ($conn->connect_error) {
        // Handle the database connection error
        http_response_code(500);
        echo json_encode(['error' => 'Database connection failed']);
        exit;
    }
    // Get the JSON payload from the request body
    $input = file_get_contents('php://input');
    $payload = json_decode($input, true);

    // Check if the email or id field exists in the payload
    if (!isset($payload['email']) && !isset($payload['id'])) {
        $response = array(
            'message' => 'Validation error',
            'errors' => ['Email or ID field is required']
        );
        http_response_code(400);
        echo json_encode($response);
        exit;
    }

    // Get the email and id from the payload
    $email = isset($payload['email']) ? $payload['email'] : '';
    $id = isset($payload['id']) ? $payload['id'] : '';

    // Create a response array
    $response = array();

    // Perform a check if the user with the provided email or id exists
    $query = "SELECT * FROM tblusers WHERE email = ? OR id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ss', $email, $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if the user exists
    if (mysqli_num_rows($result) === 1) {
        // Fetch the user payload
        $row = mysqli_fetch_assoc($result);

        // Get the updated values from the payload, if provided
        $firstName = isset($payload['firstName']) ? $payload['firstName'] : $row['firstName'];
        $lastName = isset($payload['lastName']) ? $payload['lastName'] : $row['lastName'];
        $phoneNumber = isset($payload['phoneNumber']) ? $payload['phoneNumber'] : $row['phoneNumber'];
        $dateOfBirth = isset($payload['dateOfBirth']) ? $payload['dateOfBirth'] : $row['dateOfBirth'];

        // Validate and sanitize the input fields
        $firstName = validateField($firstName, 'First Name');
        $lastName = validateField($lastName, 'Last Name');
        $phoneNumber = validatePhoneNumber($phoneNumber);
        $dateOfBirth = validateDate($dateOfBirth, 'Y-m-d');

        // Update the user details in the database
        $updateQuery = "UPDATE tblusers SET firstName = ?, lastName = ?, phoneNumber = ?, dateOfBirth = ? WHERE email = ?";
        $updateStmt = mysqli_prepare($conn, $updateQuery);
        mysqli_stmt_bind_param($updateStmt, 'sssss', $firstName, $lastName, $phoneNumber, $dateOfBirth, $email);
        mysqli_stmt_execute($updateStmt);

        // Check if any rows were affected
        $rowsAffected = mysqli_stmt_affected_rows($updateStmt);
        if ($rowsAffected > 0) {
            $response['message'] = 'User details updated successfully';
            http_response_code(200);
        } else {
            $response['message'] = 'Failed to update user details';
            http_response_code(500);
        }

        // Close the statement
        mysqli_stmt_close($updateStmt);
    } else {
        $response['message'] = 'User not found';
        http_response_code(404);
    }

    // Close the statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    // Return the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// Handle unsupported HTTP methods
$response = array(
    'message' => 'Method Not Allowed'
);
http_response_code(405);
header('Content-Type: application/json');
echo json_encode($response);
exit;

// Function to validate and sanitize a field
function validateField($field, $fieldName) {
    $field = trim($field);
    if (!empty($field)) {
        return htmlspecialchars($field);
    }
    return null;
}

// Function to validate a phone number field
function validatePhoneNumber($phoneNumber) {
    $phoneNumber = validateField($phoneNumber, 'Phone Number');
    if (!empty($phoneNumber) && !preg_match('/^\d{10}$/', $phoneNumber)) {
        $response['error'] = 'Invalid Phone Number format';
        http_response_code(400);
        echo json_encode($response);
        exit;
    }
    return $phoneNumber;
}

// Function to validate a date field
function validateDate($date, $format) {
    $dateObj = DateTime::createFromFormat($format, $date);
    if (!empty($date) && (!$dateObj || $dateObj->format($format) !== $date)) {
        $response['error'] = 'Invalid Date format';
        http_response_code(400);
        echo json_encode($response);
        exit;
    }
    return $date;
}
?>
