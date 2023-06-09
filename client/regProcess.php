<?php

// Include the database conn file
//require_once 'config.php';
include '../config/config.php';


function validateNotEmpty($variables)
{
    foreach ($variables as $variable) {
        if (empty($variable)) {
            $message ="No submit of blank details allowed";
            $message=htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
            //throw new Exception($message);
            header("Location: register.php?message=" . urlencode($message));
            exit;

            
        }
    }
}


try {
    // Sanitize and retrieve the input values
    $firstName = sanitizeInput($_POST['firstName']);
    $lastName = sanitizeInput($_POST['lastName']);
    $email = sanitizeInput($_POST['email']);
    $telephone = sanitizeInput($_POST['telephone']);
    $dob = sanitizeInput($_POST['dob']);
    $password = sanitizeInput($_POST['password']);
    $confirmPassword = sanitizeInput($_POST['confirmPassword']);

    // Validate that the variables are not empty
    $variables = [$firstName, $lastName, $email, $telephone, $dob, $password, $confirmPassword];
    validateNotEmpty($variables);
/*
// Retrieve form data and sanitize
$firstName = sanitizeInput($_POST['firstName']);
$lastName = sanitizeInput($_POST['lastName']);
$email = sanitizeInput($_POST['email']);
$telephone = sanitizeInput($_POST['telephone']);
$dob = sanitizeInput($_POST['dob']);
$password = sanitizeInput($_POST['password']);
$confirmPassword = sanitizeInput($_POST['confirmPassword']); 
*/

// Validate form data
$errors = array();

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format";
}

// Check if password and confirm password match
if ($password !== $confirmPassword) {
    $errors[] = "Passwords do not match";
}

if (strlen($password) < 6 || strlen($password) > 10) {
    $errors[] = "Password length should be between 6 and 10 characters";
} elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/', $password)) {
    $errors[] = "Password must contain at least one lowercase letter, one uppercase letter, one digit, one special character, and must not be your name.";
}


// Check if email already exists in the database
if (empty($errors)) {
    $safeEmail = mysqli_real_escape_string($conn, $email);
    $query = "SELECT * FROM tblusers WHERE email = '$safeEmail'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $errors[] = "User with the submitted email already exists";
    }
}


// Check if telephone number is valid and does not exist in the database
if (empty($errors)) {
    if (!preg_match('/^[0-9]{10}$/', $telephone)) {
        $errors[] = "Invalid telephone number. It must be a 10-digit number starting with 0.";
    } else {
        $safeTelephone = mysqli_real_escape_string($conn, $telephone);
        $query = "SELECT * FROM tblusers WHERE phoneNumber = '$safeTelephone'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $errors[] = "User with the submitted telephone number already exists";
        }
    }
}
if (empty($errors)) {
    $today = new DateTime();
    $dobDate = DateTime::createFromFormat('Y-m-d', $dob);
    $age = $today->diff($dobDate)->y;

    if ($age < 7) {
        $errors[] = "Minimum age allowed is 7 years";
    }
}

// If there are no errors, insert the data into the database
if (empty($errors)) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password for security
    $safeFirstName = mysqli_real_escape_string($conn, $firstName);
    $safeLastName = mysqli_real_escape_string($conn, $lastName);
    $safeEmail = mysqli_real_escape_string($conn, $email);
    $safeTelephone = mysqli_real_escape_string($conn, $telephone);
    $query = "INSERT INTO tblusers (firstName, lastName, email, phoneNumber, dateOfBirth, password) VALUES ('$safeFirstName', '$safeLastName', '$safeEmail', '$safeTelephone', '$dob', '$hashedPassword')";
    //mysqli_query($conn, $query);
    mysqli_query($conn, $query) or die(mysqli_error($conn));

    $message = "Registration successful"; 
} else {
    $message = implode("<br>", $errors);
}

// Close the database conn
mysqli_close($conn);

// Return the message to the registration page
header("Location: register.php?message=" . urlencode($message));
exit();

} catch (Exception $e) {
    // Handle the exception and display the error message
    echo $e->getMessage();
}
// Function to sanitize form input
function sanitizeInput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
?>




<?php
/*
// Database processing
    include '../config/config.php'; // Include your database configuration file or establish a connection here

    // Prepare the SQL query
    $stmt = mysqli_prepare($conn, "INSERT INTO tblusers (firstName, lastName, email, phoneNumber, dateOfBirth, password) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'ssssss', $firstName, $lastName, $email, $telephone, $dob, $password);

    // Execute the SQL query
    mysqli_stmt_execute($stmt);

    // Close the statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    // Redirect to a success page or display a success message
    header("Location: success.php");
    exit;*/
    ?>