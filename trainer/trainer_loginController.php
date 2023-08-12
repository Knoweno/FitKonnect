<?php
session_start();
include '../config/config.php';
require_once '../links.php';

// Function to sanitize input data
function sanitizeInput($input) {
    return filter_var($input, FILTER_SANITIZE_STRING);
}

if (isset($_POST['btnsubmit'])) {
    $username = sanitizeInput($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $_SESSION['error_message'] = "Invalid input.";
    } else {
        // Perform login authentication
        $query = "SELECT * FROM tbltrainers WHERE (email = ? OR phoneNumber = ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'ss', $username, $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        if ($row && password_verify($password, $row['password'])) {
            // Login successful
            $_SESSION['trainer_email'] = $row['email'];
            $_SESSION['success_message'] = "Login successful.";
            //header("Location: $locallink/trainer/trainer_registration.php");
            //exit;
        } else {
            // Login failed, set error message for display
            $_SESSION['error_message'] = "Invalid username or password.";
        }
    }
    header("Location: http://localhost/Projects/FitKonnect/trainer/"); // Redirect to login page
    exit;
}
?>
