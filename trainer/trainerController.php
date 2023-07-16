<?php
session_start();
include '../config/config.php';
require_once '../links.php';


function validateNotEmpty($variables)
{
    global $locallink;
    foreach ($variables as $variable) {
        if (empty($variable)) {
            $message = "No submission of blank details allowed";
            header("Location: $locallink/trainer/trainer.php?message=" . urlencode($message));
            exit;
        }
    }
}

try {
    // Sanitize and retrieve the input values
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    $confirmPassword = sanitizeInput($_POST['confirmPassword']);

    // Validate that the variables are not empty
    $variables = [$email, $password, $confirmPassword];
    validateNotEmpty($variables);

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
        $query = "SELECT * FROM tbltrainers WHERE email = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if (mysqli_num_rows($result) > 0) {
            $errors[] = "User with the submitted email already exists";
        }

        mysqli_stmt_close($stmt);
    }

    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password for security
        $query = "INSERT INTO tbltrainers (email, password) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'ss', $email, $hashedPassword);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $message = "Registration successful";
        header("Location: $locallink/trainer/trainer_registration.php");
    } else {
        $message = implode("<br>", $errors);
    }

    // Close the database connection
    mysqli_close($conn);

    // Return the message to the registration page
    header("Location: $locallink/trainer/trainer.php?message=" . urlencode($message));
    exit();
} catch (Exception $e) {
    // Handle the exception and display the error message
    $message = "Error occured. Please contact System Administrator";
    header("Location: $locallink/trainer.php?message=" . urlencode($message));
    exit;
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
