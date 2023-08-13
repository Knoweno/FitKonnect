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
        
        if ($row) {
            // User found based on email/phone number
            $hashedPassword = $row['password'];
            if (password_verify($password, $hashedPassword)) {
                // Password matches, log the user in
                // You can set session variables or perform any other actions needed
                //$_SESSION['user_id'] = $row['id']; // Assuming you have a column 'id' in your table
                // $_SESSION['username'] = $row['email']; // Store user's identifier
                // header("Location: dashboard.php"); // Redirect to the dashboard page
                // exit();
                $_SESSION['email'] = $row['email'];
                $_SESSION['success_message'] ="Login success";
                header("Location: ./"); // Redirect back to login page with error message
                exit();
                 //header("Location: https://chat.openai.com/");
        //exit;
            } else {
                $_SESSION['error_message'] = "Invalid username or password.";
                header("Location: ./"); // Redirect back to login page with error message
                exit();
            }
        } else {
            $_SESSION['error_message'] = "Invalid username or password.";
            header("Location: ./"); // Redirect back to login page with error message
            exit();
        }
    }
    header("Location: http://localhost/Projects/FitKonnect/trainer/"); // Redirect to login page
    exit;
}
?>
