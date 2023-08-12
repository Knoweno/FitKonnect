<?php
session_start();
include '../config/config.php';
require_once '../links.php';

function generateRandomPassword($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}

if (isset($_POST['btnsubmit'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if ($email === false) {
        $_SESSION['reset_message'] = "Invalid email format.";
    } else {
        // Check if the email exists in your database
        // If yes, generate a new random password, update it in the database, and send it to the user's email
        $query = "SELECT * FROM tbltrainers WHERE email = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        if ($user) {
            $newPassword = generateRandomPassword();
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update the password in the database
            $updateQuery = "UPDATE tbltrainers SET password = ? WHERE email = ?";
            $updateStmt = mysqli_prepare($conn, $updateQuery);
            mysqli_stmt_bind_param($updateStmt, 'ss', $hashedPassword, $email);
            mysqli_stmt_execute($updateStmt);
            mysqli_stmt_close($updateStmt);

            // Send password reset email to the user (you need to implement this part)
            // Example: mail($email, 'Password Reset', 'Your new password: ' . $newPassword);

            $_SESSION['reset_message'] = "Password reset instructions sent to your email.";
        } else {
            $_SESSION['reset_message'] = "Email not found.";
        }
    }
    header("Location: forgot_password.php"); // Redirect to forgot password page
    exit;
}
?>
