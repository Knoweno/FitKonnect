<?php
session_start();
include '../config/config.php';

function validateNotEmpty($variables)
{
    foreach ($variables as $variable) {
        if (empty($variable)) {
            $message = "No submission of blank details allowed";
            $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
            header("Location: trainer.php?message=" . urlencode($message));
            exit;
        }
    }
}

try {
    // Sanitize and retrieve the input values
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    $confirmPassword = sanitizeInput($_POST['confirmPassword']);

    // Check if all fields are filled
    $variables = [$email, $password, $confirmPassword];
    validateNotEmpty($variables);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format";
    }
    // Check if password and confirm password match
    elseif ($password !== $confirmPassword) {
        $message = "Passwords do not match";
    }
    // Validate password length and complexity
    elseif (strlen($password) < 6 || strlen($password) > 10) {
        $message = "Password length should be between 6 and 10 characters";
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/', $password)) {
        $message = "Password must contain at least one lowercase letter, one uppercase letter, one digit, one special character, and must not be your name.";
    }
    // Check if email already exists in the database
    else {
        $checkExistsQuery = "CALL CheckTrainerEmail(?, @exists)";
        $checkExistsStmt = mysqli_prepare($conn, $checkExistsQuery);
        mysqli_stmt_bind_param($checkExistsStmt, 's', $email);
        mysqli_stmt_execute($checkExistsStmt);
        mysqli_stmt_close($checkExistsStmt);

        $result = mysqli_query($conn, "SELECT @exists AS exists");
        $row = mysqli_fetch_assoc($result);
        $exists = $row['exists'];

        if ($exists > 0) {
            $message = "User with the submitted email already exists";
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert trainer using the stored procedure
            $insertTrainerQuery = "CALL InsertTrainer(?, ?)";
            $insertTrainerStmt = mysqli_prepare($conn, $insertTrainerQuery);
            mysqli_stmt_bind_param($insertTrainerStmt, 'ss', $email, $hashedPassword);
            mysqli_stmt_execute($insertTrainerStmt);
            mysqli_stmt_close($insertTrainerStmt);

            $message = "Registration successful";
            header("Location: trainer_registration.php");
            exit;
        }
    }

    // Close the database connection
    mysqli_close($conn);

    // Redirect back to the registration page with the error message
    header("Location: trainer.php?message=" . urlencode($message));
    exit;
} catch (Exception $e) {
    // Handle the exception and display the error message
    $message = "No submission of blank details allowed";
    $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
    header("Location: trainer.php?message=" . urlencode($message));
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
