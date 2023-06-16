<?php
// resetProcess.php
include 'config.php';
// Check if the user is already logged in, if so, redirect to home page
// Assuming you have a session management system in place
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: http://localhost/fitkonect/");
    exit();
}

// Check if the user's email/phone is stored in the session
if (!isset($_SESSION['reset_email_or_phone'])) {
    // Redirect to reset.php if email/phone is not set
    header("Location: passreset.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emailOrPhone = $_SESSION['reset_email_or_phone'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Perform input validation here

    // Check if the passwords match
    if ($password !== $confirmPassword) {
        // Passwords don't match, handle the error (e.g., display an error message)
        header("Location: resetProcess.php?error=PasswordMismatch");
        exit();
    }

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Update the user's password in the database
    $query = "UPDATE tblusers SET password = ? WHERE email = ? OR phoneNumber = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $hashedPassword, $emailOrPhone, $emailOrPhone);
    $stmt->execute();

    // Check if the password update was successful
    if ($stmt->affected_rows > 0) {
        // Password reset successful, redirect to login page with success message
        header("Location: login.php?success=PasswordReset");
        exit();
    } else {
        // Password update failed, handle the error (e.g., display an error message)
        header("Location: resetProcess.php?error=PasswordUpdateFailed");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <h1>Password Reset</h1>
    <?php
    // Check if there is an error message from the password reset form
    if (isset($_GET['error'])) {
        if ($_GET['error'] === 'PasswordMismatch') {
            echo '<div id="errorMessage" class="alert alert-danger"> Passwords do not match. Please try again. </div>';
        } elseif ($_GET['error'] === 'PasswordUpdateFailed') {
            echo '<div id="errorMessage" class="alert alert-danger"> assword update failed. Please try again.</div>';
        }
    }
    ?>
    <form method="POST" action="resetProcess.php">
        <label for="password">New Password:</label>
        <input type="password" id="password" name="password" required><br>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br>
        <button type="submit">Reset Password</button>
    </form>


    <script>
        $(document).ready(function() {
          
            // Hide the message modal after 5 seconds
            setTimeout(function() {
                $('#errorMessage, #successMessage').fadeOut('slow');
            }, 5000);
        });
    </script>
</body>
</html>
