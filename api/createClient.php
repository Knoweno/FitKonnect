<?php


// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


// Set up the database connection details
// $servername = "localhost";
// $username = "root";
// $dbpassword = "";
// $dbname = "Fitkonnect";

// Create a response array to hold the API response
$response = array();
$myJsonResponse = "header('Content-Type: application/json'); echo json_encode(\$response);";


// Handle HTTP POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the input data from the request payload
    $payload = json_decode(file_get_contents('php://input'), true);

    // Validate and sanitize the input fields
    $firstName = validateField($payload['firstName'], 'First Name');
    $lastName = validateField($payload['lastName'], 'Last Name');
    $phoneNumber = validatePhoneNumber($payload['phoneNumber']);
    $email = validateEmail($payload['email']);
    $dateOfBirth = validateDate($payload['dateOfBirth'], 'Y-m-d');
    $password = validateField($payload['password'], 'Password');
    $confirmPassword = validateField($payload['confirmPassword'], 'Confirm Password');

    // Check if user with email or phoneNumber already exists
    if (checkUserExists($email, $phoneNumber)) {
        $response['error'] = 'User with the provided email or phone number already exists';
        http_response_code(400);
    } else {

        // Check if the password combination is valid
if (!validatePassword($password)) {
    $response['error'] = 'Invalid password combination. Password must be 6-8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.';
    http_response_code(400);
    eval($myJsonResponse);
    exit;
}else{
        // Verify if password and confirm password match
        if ($password !== $confirmPassword) {
            $response['error'] = 'Password and Confirm Password do not match';
            http_response_code(400);
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Create a new user in the database
            if (createUser($firstName, $lastName, $phoneNumber, $email, $dateOfBirth, $hashedPassword)) {
                $response['message'] = 'User registered successfully';
                http_response_code(201);
            } else {
                $response['error'] = 'Failed to register user';
                http_response_code(500);
            }
        }
    }
    }
} else {
    // Handle unsupported HTTP methods
    $response['error'] = 'Method Not Allowed';
    http_response_code(405);
}

// Set the response headers and echo the response as JSON
header('Content-Type: application/json');
echo json_encode($response);


// Function to validate and sanitize a field
function validateField($field, $fieldName) {
    global $myJsonResponse;
    $field = trim($field);
    if (empty($field)) {
        $response['error'] = $fieldName . ' is required';
        http_response_code(400);
        eval($myJsonResponse);
        exit;
    }
    return htmlspecialchars($field);
}

// Function to validate a phone number field
function validatePhoneNumber($phoneNumber) {
    global $myJsonResponse;
    $phoneNumber = validateField($phoneNumber, 'Phone Number');
    if (!preg_match('/^\d{10}$/', $phoneNumber)) {
        $response['error'] = 'Invalid Phone Number format';
        http_response_code(400);
        eval($myJsonResponse);
        exit;
    }
    return $phoneNumber;
}

// Function to validate an email field
function validateEmail($email) {
    global $myJsonResponse;
    $email = validateField($email, 'Email');
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['error'] = 'Invalid Email format';
        http_response_code(400);
        eval($myJsonResponse);
        exit;
    }
    return $email;
}

// Function to validate a date field
function validateDate($date, $format) {
    global $myJsonResponse;
    $dateObj = DateTime::createFromFormat($format, $date);
    if (!$dateObj || $dateObj->format($format) !== $date) {
        $response['error'] = 'Invalid Date format';
        http_response_code(400);
        eval($myJsonResponse);
        exit;
    }
    return $date;
}

// Function to check if a user with the provided email or phone number already exists
function checkUserExists($email, $phoneNumber) {

     global $host, $user, $hostpassword, $database, $socket;

    $conn = new mysqli($host, $user, $hostpassword, $database, $socket);
    if ($conn->connect_error) {
        $response['error'] = 'Database Connection Error';
        http_response_code(500);
        exit;
    }

    $stmt = $conn->prepare('SELECT * FROM tblusers WHERE email = ? OR phoneNumber = ?');
    $stmt->bind_param('ss', $email, $phoneNumber);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->num_rows > 0;
}

// Function to create a new user in the database
function createUser($firstName, $lastName, $phoneNumber, $email, $dateOfBirth, $password) {

    
    global $host, $user, $hostpassword, $database, $socket;

    $conn = new mysqli($host, $user, $hostpassword, $database, $socket);
    if ($conn->connect_error) {
        $response['error'] = 'Database Connection Error';
        http_response_code(500);
        exit;
    }

    $stmt = $conn->prepare('INSERT INTO tblusers (firstName, lastName, phoneNumber, email, dateOfBirth, password) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->bind_param('ssssss', $firstName, $lastName, $phoneNumber, $email, $dateOfBirth, $password);

    return $stmt->execute();
}
function validatePassword($password) {
    // Minimum length of 6 characters
    if (strlen($password) < 6) {
        return false;
    }

    // Maximum length of 8 characters
    if (strlen($password) > 8) {
        return false;
    }

    // Must contain at least one uppercase letter, one lowercase letter, one number, and one special character
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z])/', $password)) {
        return false;
    }

    return true;
}


