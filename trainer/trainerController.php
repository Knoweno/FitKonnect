<?php
// Include the database conn file
//require_once 'config.php';
include '../config/config.php';

// Retrieve form data and sanitize
$email = sanitizeInput($_POST['email']);
$password = sanitizeInput($_POST['password']);
$confirmPassword = sanitizeInput($_POST['confirmPassword']);

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
    $query = "SELECT * FROM tbltrainers WHERE email = '$safeEmail'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $errors[] = "User with the submitted email already exists";
    }
}

if (empty($errors)) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password for security
    $safeEmail = mysqli_real_escape_string($conn, $email);
    $query = "INSERT INTO tbltrainers (email, password) VALUES ('$safeEmail','$hashedPassword')";
   // mysqli_query($conn, $query);
    mysqli_query($conn, $query) or die(mysqli_error($conn));

    $message = "Registration successful";
} else {
    $message = implode("<br>", $errors);
}


// Close the database conn
mysqli_close($conn);

// Return the message to the registration page
header("Location: trainer.php?message=" . urlencode($message));
exit();

// Function to sanitize form input
function sanitizeInput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
?>
