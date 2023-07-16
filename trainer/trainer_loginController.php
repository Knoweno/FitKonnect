<?php
session_start();
include '../config/config.php';
require_once '../links.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input data
    $username = $_POST['username'];
    $password = $_POST['password'];

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
        header("Location: $locallink/trainer_registration.php");
        exit;
    } else {
        // Login failed
        $message = "Invalid username or password.";
        header("Location: $locallink/?message=$message");
        exit;
    }
}
?>
