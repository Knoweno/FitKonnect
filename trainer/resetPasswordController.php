<?php
session_start();
include '../config/config.php';
require_once '../links.php';

function sanitizeInput($input) {
    return filter_var($input, FILTER_SANITIZE_STRING);
}

if (isset($_POST['btnsubmit'])) {
    $email = sanitizeInput($_POST['email']);
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if the user with the provided email exists
    $query = "SELECT * FROM tbltrainers WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if (!$user) {
        $_SESSION['error_message'] = "An error occurred. Please try again.";
    } else {
        if ($newPassword !== $confirmPassword) {
            $_SESSION['error_message'] = "Passwords do not match.";
        } else {
            // Update the password in the database
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $updateQuery = "UPDATE tbltrainers SET password = ? WHERE email = ?";
            $updateStmt = mysqli_prepare($conn, $updateQuery);
            mysqli_stmt_bind_param($updateStmt, 'ss', $hashedPassword, $email);
            mysqli_stmt_execute($updateStmt);
            mysqli_stmt_close($updateStmt);

            $_SESSION['success_message'] = "Password reset successful.Please log in";
            //header("Location: localhost/Projects/FitKonnect/trainer/");
        }
    }
    header("Location: resetPassword.php"); // Redirect to forgot password page
    exit;
}
?>
